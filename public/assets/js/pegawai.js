$(document).ready(function () {
    function fetchData() {
        $.ajax({
            url: "pegawai/fetchData", // Endpoint di Laravel
            type: "GET",
            success: function (response) {
                if (response.success) {
                    $(".datanew").DataTable({
                        data: response.data, // Memasukkan data JSON ke DataTable
                        columns: [
                            {
                                data: null,
                                render: function (data, type, row, meta) {
                                    return meta.row + 1; // Menambahkan nomor urut otomatis
                                },
                            },
                            { data: "nip" }, // Nama Nampan dari relasi
                            { data: "nama" }, // Tanggal dari data utama
                            { data: "jabatan_id" },
                            { data: "status" },
                            {
                                data: "id",
                                name: "id",
                                orderable: false,
                                searchable: false,
                                render: function (data) {
                                    return `
                                        <div class="edit-delete-action">
                                            <a class="me-2 edit-icon p-2" data-bs-effect="effect-sign" data-bs-toggle="modal" href="#modaldetail${data}">
                                                <i data-feather="eye" class="feather-eye"></i>
                                            </a>
                                            <a class="me-2 p-2" data-bs-effect="effect-sign" data-bs-toggle="modal" href="#modaledit${data}">
                                                <i data-feather="edit" class="feather-edit"></i>
                                            </a>
                                            <a class="me-2 p-2" data-bs-effect="effect-sign" data-bs-toggle="modal" href="#modaluser${data}">
                                                <i data-feather="user-check" class="feather-user"></i>
                                            </a>
                                            <a class="me-2 p-2" onclick="confirm_modal('delete-pegawai/${data}');" data-bs-toggle="modal" data-bs-target="#modal_delete">
                                                <i data-feather="trash-2" class="feather-trash-2"></i>
                                            </a>
                                        </div>`;
                                },
                            },
                        ],
                        autoWidth: false, // Mengatur agar DataTable tidak otomatis mengatur lebar kolom
                        responsive: true, // Agar tabel responsif
                        width: "100%", // Menentukan lebar tabel
                        destroy: true, // Menambahkan opsi ini jika tabel sebelumnya sudah diinisialisasi
                    });
                }
            },
            error: function (xhr, status, error) {
                console.error("Error fetching data:", error);
            },
        });
    }

    fetchData();

    function confirm_modal(delete_url) {
        $("#modal_delete").modal("show", {
            backdrop: "static",
        });
        document.getElementById("delete_link").setAttribute("href", delete_url);
    }

    const imgInput = document.getElementById("image");
    const previewImage = document.getElementById("preview");

    imgInput.addEventListener("change", () => {
        const file = imgInput.files[0];
        const reader = new FileReader();

        reader.addEventListener("load", () => {
            previewImage.innerHTML = "";
            const img = document.createElement("img");
            img.src = reader.result;

            previewImage.appendChild(img);
        });

        reader.readAsDataURL(file);
    });
});

$(document).ready(function () {
    $("#filterSearch").on("click", function () {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            type: "POST",
            url: "stok",
            data: {
                tglDari: $("#tglDari").val(),
                tglSampai: $("#tglSampai").val(),
                _token: $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                if (response.success) {
                    $(".datanew").DataTable({
                        data: response.Data, // Memasukkan data JSON ke DataTable
                        columns: [
                            {
                                data: null,
                                render: function (data, type, row, meta) {
                                    return meta.row + 1; // Menambahkan nomor urut otomatis
                                },
                            },
                            { data: "nampan" }, // Nama Nampan dari relasi
                            { data: "total_produk"}, // Tanggal dari data utama
                            { data: "total_berat" }
                        ],
                        autoWidth: false,   // Mengatur agar DataTable tidak otomatis mengatur lebar kolom
                        responsive: true,   // Agar tabel responsif
                        width: "100%",      // Menentukan lebar tabel
                        destroy: true, // Menambahkan opsi ini jika tabel sebelumnya sudah diinisialisasi
                    });
                } else {
                    console.error("Data tidak ditemukan.");
                }
            },
            error: function (xhr) {
                console.error(xhr);
            },
        });
    });
});

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
                            { data: "nampan.nampan" }, // Nama Nampan dari relasi
                            { data: "produk.nama" }, // Nama Produk dari relasi
                            { data: "tanggal" }, // Tanggal dari data utama
                            { data: "produk.kodeproduk" }, // Kode Produk dari relasi produk
                            { data: "produk.nama" }, // Nama Produk dari relasi produk
                            { data: "produk.harga_jual" }, // Harga Jual dari relasi produk
                            { data: "produk.keterangan" }, // Keterangan Produk dari relasi produk
                        ],
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

$(document).ready(function () {
    function loadItems() {
        // Menggunakan AJAX untuk mengambil data dari server
        $.ajax({
            url: "/getKeranjang", // Endpoint di Laravel
            type: "GET",
            success: function (response) {
                // Loop melalui setiap item yang dikembalikan dari server
                $("#keranjang").empty();
                kodekeranjang = "";
                response.forEach((item) => {
                    const formatter = new Intl.NumberFormat("id-ID", {
                        style: "currency",
                        currency: "IDR",
                        minimumFractionDigits: 0, // Biasanya mata uang Rupiah tidak menggunakan desimal
                    });

                    const hargajual = formatter.format(item.harga_jual); // Output: "Rp1.500.000"
                    $("#keranjang").append(`
                        <div class="product-list d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center product-info" data-bs-toggle="modal"
                                data-bs-target="#products">
                                <a href="javascript:void(0);" class="img-bg">
                                    <img src="storage/Image/${item.image}" alt="Products">
                                </a>
                                <div class="info">
                                    <span>${item.keranjang_id}</span>
                                    <h6><a href="javascript:void(0);">${item.nama}</a></h6>
                                    <p>${hargajual}</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-center action">
                                <a class="me-2 p-2 deleteKeranjang"
                                    data-id="${item.idkeranjang}"
                                    data-bs-toggle="modal" data-bs-target="#modal_delete">
                                    <i data-feather="trash-2" class="feather-trash-2"></i>
                                </a>
                            </div>
                        </div>
                    `);
                });
            },
            error: function (xhr, status, error) {
                console.error("Error fetching data:", error);
            },
        });
    }

    loadItems();

    getCount();

    totalHargaKeranjang();

    $(document).on("click", ".deleteKeranjang", function () {
        id = $(this).data("id");
    });

    $("#deleteKeranjang").on("click", function () {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            type: "DELETE",
            url: "delete-keranjang/" + id,
            success: function (response) {
                if (response.success) {
                    $("#modal_delete").modal("hide");

                    const successtoastExample =
                        document.getElementById("successToastDelete");
                    const toast = new bootstrap.Toast(successtoastExample);
                    toast.show();

                    loadItems();
                    getCount();
                    totalHargaKeranjang();
                    getDiscount();
                }
            },
            error: function (xhr) {
                const dangertoastExamplee =
                    document.getElementById("dangerToastErrors");
                const toast = new bootstrap.Toast(dangertoastExamplee);
                toast.show();
            },
        });
    });

    function getCount() {
        $.ajax({
            url: "/getCount", // Endpoint di Laravel
            type: "GET",
            success: function (response) {
                // Loop melalui setiap item yang dikembalikan dari server
                $(".count").text(0);
                if (response.success) {
                    $(".count").text(response.count);
                } else {
                    $(".count").text(0);
                }
            },
            error: function (xhr, status, error) {
                console.error("Error fetching data:", error);
            },
        });
    }

    $(document).on("click", "#deleteAllKeranjang", function () {
        var csrfToken = $('meta[name="csrf-token"]').attr("content");

        $.ajax({
            url: `/deleteAllKeranjang`, // Route Laravel
            type: "DELETE",
            data: {
                _token: csrfToken, // Sertakan token CSRF
            },
            success: function (response) {
                if (response.success) {
                    $("#modaldeleteALlKeranjang").modal("hide");

                    const successtoastExample =
                        document.getElementById("successToastDelete");
                    const toast = new bootstrap.Toast(successtoastExample);
                    toast.show();

                    loadItems();
                    getCount();
                    totalHargaKeranjang();
                    getDiscount();
                }
            },
            error: function (xhr) {
                const dangertoastExamplee =
                    document.getElementById("dangerToastErrors");
                const toast = new bootstrap.Toast(dangertoastExamplee);
                toast.show();
            },
        });
    });

    function totalHargaKeranjang() {
        $.ajax({
            url: "/totalHargaKeranjang", // Endpoint di Laravel
            type: "GET",
            success: function (response) {
                // Loop melalui setiap item yang dikembalikan dari server
                $("#totalhargabarang").text(0);
                if (response.success) {
                    const total = response.total;

                    const formatter = new Intl.NumberFormat("id-ID", {
                        style: "currency",
                        currency: "IDR",
                        minimumFractionDigits: 0, // Biasanya mata uang Rupiah tidak menggunakan desimal
                    });

                    var formattedAmount = formatter.format(total); // Output: "Rp1.500.000"

                    $("#totalhargabarang").text(formattedAmount);
                } else {
                    $("#totalhargabarang").text(0);
                }
            },
            error: function (xhr, status, error) {
                console.error("Error fetching data:", error);
            },
        });
    }

    $(document).on("change", "#pilihDiskon", function getDiscount() {
        const diskon = $(this).val();

        $.ajax({
            url: "/totalHargaKeranjang", // Endpoint di Laravel
            type: "GET",
            success: function (response) {
                // Loop melalui setiap item yang dikembalikan dari server
                $("#hargadiskon").text(0);
                $("#total").text(0);
                $("#grandtotal").text(0);
                $("#discount").text(diskon);
                if (response.success) {
                    const total = response.total;
                    const subDiskon = diskon / 100;
                    const TotalDiskon = total * subDiskon;

                    const subTotalDiskon = total - TotalDiskon;

                    const formatter = new Intl.NumberFormat("id-ID", {
                        style: "currency",
                        currency: "IDR",
                        minimumFractionDigits: 0, // Biasanya mata uang Rupiah tidak menggunakan desimal
                    });

                    const hargatotaldiskon = formatter.format(TotalDiskon); // Output: "Rp1.500.000"
                    const hargatotal = formatter.format(subTotalDiskon); // Output: "Rp1.500.000"

                    $("#hargadiskon").text(hargatotaldiskon);
                    $("#total").text(hargatotal);
                    $("#grandtotal").text(hargatotal);
                } else {
                    $("#hargadiskon").text(0);
                    $("#total").text(0);
                    $("#grandtotal").text(0);
                    $("#discount").text(diskon);
                }
            },
            error: function (xhr, status, error) {
                console.error("Error fetching data:", error);
            },
        });
    });

    $(document).on("click", "#payment", function () {
        var csrfToken = $('meta[name="csrf-token"]').attr("content");

        const pelanggan = document.querySelector("#pelanggan").value;
        const diskon = document.querySelector("#pilihDiskon").value;
        const transaksi_id =
            document.querySelector("#transaksi_id").textContent;
        $.ajax({
            url: "/getKodeKeranjang", // Endpoint di Laravel
            type: "GET",
            success: function (response) {
                if (response.success) {
                    $.ajax({
                        url: "/totalHargaKeranjang", // Endpoint di Laravel
                        type: "GET",
                        success: function (items) {
                            // Loop melalui setiap item yang dikembalikan dari server
                            if (items.success) {
                                const total = items.total;
                                const subDiskon = diskon / 100;
                                const TotalDiskon = total * subDiskon;

                                const subTotalDiskon = total - TotalDiskon;
                                $.ajax({
                                    url: `/payment`, // Route Laravel
                                    type: "POST",
                                    data: {
                                        _token: csrfToken, // Sertakan token CSRF
                                        pelangganID: pelanggan,
                                        diskonID: diskon,
                                        transaksiID: transaksi_id,
                                        kodeKeranjangID: response.kode,
                                        produkID: response.produk_id,
                                        total: subTotalDiskon,
                                    },
                                    success: function (response) {
                                        const successtoastExample =
                                            document.getElementById(
                                                "successToasts"
                                            );
                                        const toast = new bootstrap.Toast(
                                            successtoastExample
                                        );
                                        toast.show();
                                        loadItems();
                                        getCount();
                                        totalHargaKeranjang();
                                        getDiscount();
                                        return response;
                                    },
                                    error: function (xhr, status, error) {
                                        console.error(
                                            "Error fetching data:",
                                            error
                                        );
                                    },
                                });
                            }
                        },
                        error: function (xhr, status, error) {
                            console.error("Error fetching data:", error);
                        },
                    });
                }
            },
            error: function (xhr, status, error) {
                console.error("Error fetching data:", error);
            },
        });
    });
    
    $("ul.tabs li").click(function () {
        var $this = $(this);
        var $theTab = $(this).attr("id");
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");

        if ($this.hasClass("active")) {
        } else {
            $this
                .closest(".tabs_wrapper")
                .find("ul.tabs li, .tabs_container .tab_content")
                .removeClass("active");
            $(
                '.tabs_container .tab_content[data-tab="' +
                    $theTab +
                    '"], ul.tabs li[id="' +
                    $theTab +
                    '"]'
            ).addClass("active");

            $.ajax({
                url: `/pos/${$theTab}`,
                type: "GET",
                _token: CSRF_TOKEN,
                dataType: "json",
                success: function (data) {
                    $("#daftarProduk").empty();
                    $.each(data.Data, function (key, item) {
                        const formatter = new Intl.NumberFormat("id-ID", {
                            style: "currency",
                            currency: "IDR",
                            minimumFractionDigits: 0, // Biasanya mata uang Rupiah tidak menggunakan desimal
                        });

                        const hargajual = formatter.format(item.harga_jual); // Output: "Rp1.500.000"
                        $("#daftarProduk").append(
                            `
							<div class="col-sm-2 col-md-6 col-lg-3 col-xl-3">
								<div class="product-info default-cover card">
									<a href="javascript:void(0);" class="img-bg">
										<img src="/storage/Image/${item.image}"
											alt="Products" width="100px" height="100px"/>
									</a>
									<h6 class="cat-name">
										<a href="javascript:void(0);">KODE : ${item.kodeproduk}</a>
									</h6>
									<h6 class="product-name">
										<a href="javascript:void(0);">NAMA : ${item.nama}</a>
									</h6>
									<div
										class="d-flex align-items-center justify-content-between price">
										<span>BERAT : ${item.berat} /gram</span>
										<p>HARGA: Rp. ${hargajual}</p>
									</div>
									<div class="align-items-center justify-content-between price text-center">
                                        <button data-id="${item.id}" data-name="${item.nama}" data-harga="${item.harga_jual}" data-berat="${item.berat}" class="btn btn-sm btn-outline-primary ms-1 addCart">Add To Cart</button>
                                    </div>
								</div>
							</div>
						`
                        );
                    });
                },
            });
        }
    });

    $(document).on("click", ".addCart", function (e) {
        e.preventDefault(); // Mencegah reload halaman
        var produkID = $(this).data("id");
        var csrfToken = $('meta[name="csrf-token"]').attr("content");

        $.ajax({
            url: `/pos/cek/${produkID}`, // Route Laravel
            method: "POST",
            data: {
                id: produkID,
                _token: csrfToken, // Sertakan token CSRF
            },
            success: function (response) {
                if (response.status == "success") {
                    $.ajax({
                        url: `/pos/${produkID}`,
                        method: "POST",
                        data: {
                            _token: csrfToken,
                            id: produkID,
                        },
                        success: function (response) {
                            const successtoastExample =
                                document.getElementById("successToasts");
                            const toast = new bootstrap.Toast(
                                successtoastExample
                            );
                            toast.show();

                            loadItems();
                            getCount();
                            totalHargaKeranjang();
                            getDiscount();
                        },
                        error: function () {
                            const dangertoastExamplee =
                                document.getElementById("dangerToastErrors");
                            const toast = new bootstrap.Toast(
                                dangertoastExamplee
                            );
                            toast.show();
                        },
                    });
                }
            },
            error: function (xhr) {
                const dangertoastExamplee =
                    document.getElementById("dangerToastErrors");
                const toast = new bootstrap.Toast(dangertoastExamplee);
                toast.show();
            },
        });
    });
});

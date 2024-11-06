$(document).ready(function () {
    $(".cancelPayment").on("click", function () {
        $("#modalCancelPayment").modal("show", {
            backdrop: "static",
        });

        var id = $(this).data("id");

        $("#cancelPaymentConfirm").on("click", function () {
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
            });

            $.ajax({
                type: "DELETE",
                url: "cancelPayment/" + id,
                success: function (response) {
                    if (response.success) {
                        $("#modalCancelPayment").modal("hide");

                        const successtoastExample =
                            document.getElementById("successToastDelete");
                        const toast = new bootstrap.Toast(successtoastExample);
                        toast.show();

                        window.location.reload();
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
});

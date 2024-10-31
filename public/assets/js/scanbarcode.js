$(document).ready(function () {
    function onScanSuccess(decodedText, decodedResult) {
        // handle the scanned code as you like, for example:

        // alert(decodedText);
        $("#result").val(decodedText);
        let id = decodedText;
        html5QrcodeScanner
            .clear()
            .then((_) => {
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");
                $.ajax({
                    url: "scanqr",
                    type: "POST",
                    data: {
                        _methode: "POST",
                        _token: CSRF_TOKEN,
                        qr_code: id,
                    },
                    success: function (data) {
                        if (data) {
                            const successtoastExample =
                                document.getElementById("successToastDelete");
                            const toast = new bootstrap.Toast(
                                successtoastExample
                            );
                            toast.show();

                            window.location = "scanner/" + id;
                        } else {
                            const dangertoastExample =
                                document.getElementById("dangerToastScan");
                            const toast = new bootstrap.Toast(
                                dangertoastExample
                            );
                            toast.show();
                        }
                    },
                });
            })
            .catch((error) => {
                const dangertoastExample =
                    document.getElementById("dangerToastScan");
                const toast = new bootstrap.Toast(dangertoastExample);
                toast.show();
            });
    }

    function onScanFailure(error) {
        // handle scan failure, usually better to ignore and keep scanning.
        // for example:
        // console.warn(`Code scan error = ${error}`);
    }

    let html5QrcodeScanner = new Html5QrcodeScanner(
        "reader",
        {
            fps: 10,
            qrbox: {
                width: 250,
                height: 250,
            },
        },
        /* verbose= */
        false
    );
    html5QrcodeScanner.render(onScanSuccess, onScanFailure);
});

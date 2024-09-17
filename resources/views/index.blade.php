<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="POS - Bootstrap Admin Template">
    <meta name="keywords"
        content="admin, estimates, bootstrap, business, corporate, creative, invoice, html5, responsive, Projects">
    <meta name="author" content="Dreamguys - Bootstrap Admin Template">
    <meta name="robots" content="noindex, nofollow">
    <title>Login - Unggul Kencana</title>

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets') }}/img/favicon.png">

    <link rel="stylesheet" href="{{ asset('assets') }}/css/bootstrap.min.css">

    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/toastr/toatr.css">

    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/fontawesome/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('assets') }}/css/style.css">
</head>

<body class="account-page">

    <div class="main-wrapper">
        <div class="account-content">
            <div class="login-wrapper login-new">
                <div class="container">
                    <div class="login-content user-login">
                        <div class="login-logo">
                            <img src="{{ asset('assets') }}/img/logo.png" alt="img">
                        </div>
                        <form action="login" method="POST">
                            @csrf
                            <div class="login-userset">
                                <div class="login-userheading">
                                    <h3>Sign In</h3>
                                    <h4>Access the Dreamspos panel using your email and passcode.</h4>
                                </div>
                                <div class="form-login">
                                    <label class="form-label">Email</label>
                                    <div class="form-addons">
                                        <input type="email" class="form-control" name="email">
                                        <img src="{{ asset('assets') }}/img/icons/mail.svg" alt="img">
                                    </div>
                                </div>
                                <div class="form-login">
                                    <label>Password</label>
                                    <div class="pass-group">
                                        <input type="password" class="pass-input" name="password">
                                        <span class="fas toggle-password fa-eye-slash"></span>
                                    </div>
                                </div>
                                <div class="form-login">
                                    <button class="btn btn-login" type="submit">Sign In</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="my-4 d-flex justify-content-center align-items-center copyright-text">
                        <p>Copyright &copy; 2023 DreamsPOS. All rights reserved</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="toast-container position-fixed top-0 end-0 p-3">
        <div id="successToast" class="toast colored-toast bg-secondary-transparent" role="alert" aria-live="assertive"
            aria-atomic="true">
            <div class="toast-header bg-secondary text-fixed-white">
                <strong class="me-auto">Peringatan !</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                {{ session('success-message') }}
            </div>
        </div>
        <div id="dangerToast" class="toast colored-toast bg-danger-transparent" role="alert" aria-live="assertive"
            aria-atomic="true">
            <div class="toast-header bg-danger text-fixed-white">
                <strong class="me-auto">Peringatan !</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                {{ session('errors-message') }}
            </div>
        </div>
        <div id="dangerToastError" class="toast colored-toast bg-danger-transparent" role="alert"
            aria-live="assertive" aria-atomic="true">
            <div class="toast-header bg-danger text-fixed-white">
                <strong class="me-auto">Peringatan !</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </div>
        </div>
    </div>

    <script src="{{ asset('assets') }}/js/jquery-3.7.1.min.js" type="text/javascript"></script>

    <script src="{{ asset('assets') }}/js/feather.min.js" type="text/javascript"></script>

    <script src="{{ asset('assets') }}/js/bootstrap.bundle.min.js" type="text/javascript"></script>

    <script src="{{ asset('assets') }}/plugins/toastr/toastr.min.js" type="text/javascript"></script>
    <script src="{{ asset('assets') }}/plugins/toastr/toastr.js" type="text/javascript"></script>

    <script src="{{ asset('assets') }}/js/theme-script.js" type="text/javascript"></script>
    <script src="{{ asset('assets') }}/js/script.js" type="text/javascript"></script>

    @if ($errors->any())
        <script>
            const dangertoastExamplee = document.getElementById('dangerToastError')
            const toast = new bootstrap.Toast(dangertoastExamplee)
            toast.show()
        </script>
    @endif
    @if (session('success-message'))
        <script>
            const successtoastExample = document.getElementById('successToast')
            const toast = new bootstrap.Toast(successtoastExample)
            toast.show()
        </script>
    @elseif(session('errors-message'))
        <script>
            const dangertoastExample = document.getElementById('dangerToast')
            const toast = new bootstrap.Toast(dangertoastExample)
            toast.show()
        </script>
    @endif
</body>

</html>

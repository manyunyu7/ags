
<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="admin, dashboard">
    <meta name="author" content="DexignZone">
    <meta name="robots" content="index, follow">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Griya Sodaqo &#8211; Gerakan Sodaqo Indonesia">
    <meta property="og:title" content="Griya Sodaqo : Gerakan Sodaqo Indonesi">
    <meta property="og:description" content="Sodaqo.id telah memiliki banyak partner kolaborasi yang bersedia membantu orang orang yang membutuhkan bantuan. Selaijn itu, untuk saat ini SODAQO.id fokus menyantuni Anak Yatim Duafa yang tersebar di 17 Panti Asuhan yang berlokasi di Kota Bandung. Total penerima manfaat SODAQO adalah 451 Anak yatim">
    <meta property="og:image" content="http://feylabs.my.id/fm/apk/cover_sodaqo.png">
    <meta name="format-detection" content="telephone=no">

    <!-- PAGE TITLE HERE -->
    <title>Dompet : Payment Admin Template</title>

    <!-- FAVICONS ICON -->
    <link rel="shortcut icon" type="image/png" href="images/favicon.png">
    <link href="{{ asset('/168_res') }}/css/style.css" rel="stylesheet">

</head>

<body class="vh-100">
<div class="authincation h-100">
    <div class="container h-100">
        <div class="row justify-content-center h-100 align-items-center">
            <div class="col-md-6">
                <div class="authincation-content">
                    <div class="row no-gutters">

                        <div class="col-xl-12">


                        </div>
                        <div class="col-xl-12">
                            <div class="auth-form">
                                <div class="mb-3">
                                    @if ($errors->any())
                                        <div class="col-12">
                                            <div class="alert alert-danger left-icon-big alert-dismissible fade show">
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                        aria-label="btn-close"><span><i
                                                            class="mdi mdi-btn-close"></i></span>
                                                </button>
                                                <div class="media">
                                                    <div class="alert-left-icon-big">
                                                        <span><i class="mdi mdi-alert"></i></span>
                                                    </div>
                                                    <div class="media-body">
                                                        <h5 class="mt-1 mb-2">Error</h5>
                                                        <p class="mb-0">{!! implode('', $errors->all('<div>:message</div>')) !!}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                        @if(session() -> has('success'))
                                            @push("script")
                                                <script>
                                                    swal("Success!", "{{Session::get('success')}}", "success")
                                                </script>
                                            @endpush

                                            <div class="alert alert-success alert-dismissible fade show">
                                                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2"
                                                     fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                                                    <polygon
                                                        points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon>
                                                    <line x1="15" y1="9" x2="9" y2="15"></line>
                                                    <line x1="9" y1="9" x2="15" y2="15"></line>
                                                </svg>
                                                <strong>Success!</strong> {{Session::get( 'success' )}} Silakan Login menggunakan akun anda di halaman login
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                                                </button>
                                            </div>

                                        @endif
                                </div>
                                <h4 class="text-center mb-4">Sign up your account</h4>
                                <form method="post" action="{{url('proceedRegis')}}">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="mb-1"><strong>Nama</strong></label>
                                        <input type="text" name="user_name" class="form-control" placeholder="Nama">
                                    </div>
                                    <div class="mb-3">
                                        <label class="mb-1"><strong>Email</strong></label>
                                        <input type="email" name="user_email" class="form-control" placeholder="hello@example.com">
                                    </div>
                                    <div class="mb-3">
                                        <label class="mb-1"><strong>Contact</strong></label>
                                        <input type="number" name="user_contact" class="form-control" placeholder="Nomor Telepon (628xxx)">
                                    </div>
                                    <div class="mb-3">
                                        <label class="mb-1"><strong>Password</strong></label>
                                        <input type="password" name="user_password" placeholder="Password" class="form-control">
                                    </div>
                                    <div class="text-center mt-4">
                                        <button type="submit" class="btn btn-primary btn-block">Sign me up</button>
                                    </div>
                                </form>
                                <div class="new-account mt-3">
                                    <p>Already have an account? <a class="text-primary" href="{{url("login")}}">Sign in</a></p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--**********************************
	Scripts
***********************************-->
<!-- Required vendors -->
<script src="{{ asset('/168_res') }}/vendor/global/global.min.js"></script>
<script src="{{ asset('/168_res') }}/js/custom.min.js"></script>
<script src="{{ asset('/168_res') }}/js/dlabnav-init.js"></script>
<script src="{{ asset('/168_res') }}/js/styleSwitcher.js"></script>
<script src="{{ asset('/168_res') }}/vendor/sweetalert2/dist/sweetalert2.min.js"></script>
</body>
</html>

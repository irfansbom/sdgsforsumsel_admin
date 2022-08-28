<!doctype html>
<html lang="en" dir="ltr">

<head>

    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="SDGs for Sumsel Admin">
    <meta name="author" content="Ahmad Irfansyah">
    <meta name="keywords"
        content="admin, dashboard, dashboard ui, admin dashboard template, admin panel dashboard, admin panel html, admin panel html template, admin panel template, admin ui templates, administrative templates, best admin dashboard, best admin templates, bootstrap 4 admin template, bootstrap admin dashboard, bootstrap admin panel, html css admin templates, html5 admin template, premium bootstrap templates, responsive admin template, template admin bootstrap 4, themeforest html">

    <!-- FAVICON -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/brand/favicon.ico" />

    <!-- TITLE -->
    <title>SDGs for Sumsel Admin</title>

    <!-- BOOTSTRAP CSS -->
    <link id="style" href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

    <!-- STYLE CSS -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <link href="assets/css/dark-style.css" rel="stylesheet" />
    <link href="assets/css/skin-modes.css" rel="stylesheet" />
    <link href="assets/css/transparent-style.css" rel="stylesheet" />

    <!--- FONT-ICONS CSS -->
    <link href="assets/css/icons.css" rel="stylesheet" />

    <!-- COLOR SKIN CSS -->
    <link id="theme" rel="stylesheet" type="text/css" media="all" href="assets/colors/color1.css" />

</head>

<body>
    <!-- BACKGROUND-IMAGE -->
    <div class="login-img">
        <!-- GLOABAL LOADER -->
        <div id="global-loader">
            <img src="assets/images/loader.svg" class="loader-img" alt="Loader">
        </div>
        <!-- /GLOABAL LOADER -->
        <!-- PAGE -->
        <div class="page">
            <div class="">
                <!-- CONTAINER OPEN -->
                <div class="col col-login mx-auto">
                </div>
                <div class="container-login100">
                    <div class="wrap-login100 p-0">
                        <div class="card ">
                            <div class="card-header">
                                <div class="card-title mb-0">
                                    <h3 class="mb-0">Kode Verifikasi </h3>
                                    <h6 class="fw-light">Cek email terdaftar anda dan masukkan verifikasi disini</h6>
                                    <h6>kode dikirimkan ke email : {{ $email }} </h6>
                                </div>
                            </div>
                            <div class="card-body">
                                @include('alert')
                                <h4></h4>
                                @if ($errors->has('authFailure'))
                                    <div class="alert alert-danger" role="alert">
                                        {{ $errors->first() }}
                                    </div>
                                @endif
                                <form class="pt-3" method="POST" action="verifikasi_kode">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" name="email" value="{{ $email }}" hidden>
                                        <input type="kode_verifikasi" class="form-control form-control-lg"
                                            id="kode_verifikasi" placeholder="Kode Verifikasi" name="kode_verifikasi">
                                    </div>
                                    <div class="mt-3 text-center">
                                        <button
                                            class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">Verifikasi</button>
                                    </div>
                                    <div class="my-2 d-flex justify-content-between align-items-center">
                                    </div>
                                </form>
                                <div class="text-center mt-4 fw-light">
                                    Email tidak diterima?<button class="text-primary btn" id="kirim_ulang">kirim
                                        ulang</button>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="d-flex justify-content-center my-3">
                                    <a href="" class="social-login  text-center me-4">
                                        <i class="fa fa-instagram"></i>
                                    </a>
                                    <a href="" class="social-login  text-center me-4">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                    <a href="" class="social-login  text-center">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- CONTAINER CLOSED -->
            </div>
        </div>
        <!-- End PAGE -->

    </div>
    <!-- BACKGROUND-IMAGE CLOSED -->
    <!-- JQUERY JS -->
    <script src="assets/js/jquery.min.js"></script>
    <!-- BOOTSTRAP JS -->
    <script src="assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- SPARKLINE JS -->
    <script src="assets/js/jquery.sparkline.min.js"></script>
    <!-- CHART-CIRCLE JS -->
    <script src="assets/js/circle-progress.min.js"></script>
    <!-- Perfect SCROLLBAR JS-->
    <script src="assets/plugins/p-scroll/perfect-scrollbar.js"></script>
    <!-- INPUT MASK JS -->
    <script src="assets/plugins/input-mask/jquery.mask.min.js"></script>
    <!-- Color Theme js -->
    <script src="assets/js/themeColors.js"></script>
    <!-- CUSTOM JS -->
    <script src="assets/js/custom.js"></script>

    <script>
        $(function() {
            var email = {!! json_encode($email) !!};
            // console.log(email)
            $('#kirim_ulang').click(function(e) {
                // console.log($('#email').val())
                // console.log(email)
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}",
                    },
                    url: "{{ url('send_kode') }}",
                    type: "POST",
                    data: {
                        email: email
                    },
                    success: function(response) {
                        console.log(response)
                    }
                });
            })


        })
    </script>
</body>

</html>

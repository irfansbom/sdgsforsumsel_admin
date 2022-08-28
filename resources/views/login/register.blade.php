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
            <div class="main-container container-fluid px-5">
                <div class="row px-5">
                    <div class="col-12 col-sm-12 px-5">
                        <div class="card ">
                            <div class="card-header">
                                <div class="card-title mb-0">
                                    <h3 class="mb-0">Daftarkan Diri Anda, Perusahaan, Organisasi, Komunitas </h3>
                                    <h6 class="mb-0"> untuk berkontribusi dalam <img
                                            src="{{ url('assets/images/brand/logo-3.png') }}" alt=""></h6>
                                </div>
                            </div>
                            <div class="card-body">
                                @include('alert')
                                <form class="forms-sample needs-validation" novalidate method="post"
                                    action="{{ url('register') }}">
                                    @csrf
                                    <div class="row mb-2">
                                        <div class="col-6">
                                            <div class="form-group mb-1">
                                                <label for="nama">Nama</label>
                                                <input type="text" class="form-control " id="nama"
                                                    name="nama" placeholder="Nama" required autocomplete="off"
                                                    value="{{ old('nama') }}">
                                            </div>
                                            <div class="form-group mb-1">
                                                <label for="email">Email address</label>
                                                <input type="email" class="form-control notspace" id="email"
                                                    name="email" placeholder="Email" autocomplete="off" required
                                                    value="{{ old('email') }}">
                                            </div>
                                            <div class="form-group mb-1">
                                                <label for="instansi">Instansi/Organisasi</label>
                                                <input type="text" class="form-control" id="instansi"
                                                    name="instansi" placeholder="Instansi/Organisasi" required
                                                    autocomplete="off" value="{{ old('instansi') }}">
                                            </div>
                                            <div class="form-group mb-1">
                                                <label for="kabkot">Kabupaten/Kota</label>
                                                <select class="form-control text-dark " name="kabkot" required
                                                    id="kabkot">
                                                    <option value="">Pilih Kabupaten/Kota</option>
                                                    @foreach ($kabkot as $kab)
                                                        @if (old('kabkot') == $kab->id_kab)
                                                            <option value="{{ $kab->id_kab }}" selected>
                                                                {{ $kab->nama_kab }}
                                                            </option>
                                                        @else
                                                            <option value="{{ $kab->id_kab }}">{{ $kab->nama_kab }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group mb-1">
                                                <label for="password">Password</label>
                                                <input type="password" class="form-control" id="password"
                                                    name="password" placeholder="Password" autocomplete="off" required
                                                    value="{{ old('password') }}">
                                            </div>

                                            <div class="form-group mb-1">
                                                <label for="confirmpassword">Confirm Password</label>
                                                <input type="password" class="form-control" id="confirmpassword"
                                                    name="confirmpassword" placeholder="Confirm Password"
                                                    aria-describedby="validationconfirmpassword" required
                                                    autocomplete="off">
                                                <div id="validationconfirmpassword" class="invalid-feedback">
                                                    Password Tidak Sama
                                                </div>
                                            </div>

                                            <div class="form-group mb-1">
                                                <label for="captcha">Captcha</label>
                                                <div class="captcha">
                                                    <span>{!! captcha_img() !!}</span>
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        class="reload" id="reload">
                                                        &#x21bb;
                                                    </button>
                                                </div>

                                            </div>
                                            <div class="form-group mb-1">
                                                <label for="">Enter Captcha</label>
                                                <input type="text" class="form-control " id="captcha"
                                                    name="captcha" placeholder="captcha" required autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                                    <a class="btn btn-light" href="{{ url('login') }}">Cancel</a>
                                </form>
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
        (function() {
            'use strict'
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')
            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }
                        matchPassword(event);
                        form.classList.add('was-validated')
                    }, false)
                })
        })()
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()

            $('.notspace').on('keypress', function(e) {
                if (e.which == 32) {
                    console.log('Space Detected');
                    return false;
                }
            });

            $('#confirmpassword').on('keyup', function() {
                matchPassword();
                console.log(document.getElementById("password").value)
                console.log(document.getElementById("confirmpassword").value)
            })

        })

        function matchPassword(event) {
            var pw1 = document.getElementById("password");
            var pw2 = document.getElementById("confirmpassword");
            if (pw1.value != pw2.value) {
                $('#confirmpassword').css("border", "1px solid red");
                $('#confirmpassword').addClass('is-invalid')
                event.preventDefault()
                event.stopPropagation()
            } else {
                $('#confirmpassword').css("border", "1px solid #dee2e6");
                $('#confirmpassword').removeClass('is-invalid')
            }
        }
        $('#reload').click(function() {
            $.ajax({
                type: 'GET',
                url: 'reload-captcha',
                success: function(data) {
                    $(".captcha span").html(data.captcha);
                }
            });
        });
    </script>
</body>

</html>

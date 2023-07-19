<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="robots" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Salero:Restaurant Admin Bootstrap 5 Template">
    <meta property="og:title" content="Salero:Restaurant Admin Bootstrap 5 Template">
    <meta property="og:description" content="Salero:Restaurant Admin Bootstrap 5 Template">
    <meta property="og:image" content="social-image.png">
    <meta name="format-detection" content="telephone=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- PAGE TITLE HERE -->
    <title>ADMIN | LOGIN</title>

    <!-- FAVICONS ICON -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('logo') }}/logoAlfitri.png">
    <link href="{{ asset('admin/') }}/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="{{ asset('admin/') }}/css/style.css" rel="stylesheet">
    <link href="{{ asset('alert/css/sweetalert2.css')}} " rel="stylesheet" />

</head>

<body class="vh-100">
    <div class="page-wraper">

        <!-- Content -->
        <div class="browse-job login-style3">
            <!-- Coming Soon -->
            <div class="bg-img-fix overflow-hidden"
                style="background:#fff url({{URL::to('admin/bgabon.png')}}); height: 100%; background-position: center;
				background-repeat: no-repeat;
				background-size: cover;">
                <div class="row gx-0">
                    <div class="col-xl-4 col-lg-5 col-md-6 col-sm-12 vh-100 bg-login ">
                        <div id="mCSB_1" class="mCustomScrollBox mCS-light mCSB_vertical mCSB_inside"
                            style="max-height: 653px;" tabindex="0">
                            <div id="mCSB_1_container" class="mCSB_container" style="position:relative; top:0; left:0;"
                                dir="ltr">
                                <div class="login-form style-2">


                                    <div class="card-body">
                                        <div class="logo-header">
                                            <a href="{{ url('admin') }}" class="logo"><img src="{{ asset('logo') }}/logoAlfitri.png"
                                                    alt="" class="light-logo" style="width: 70px; height:auto; filter: contrast(1)"></a>
                                            <a href="{{ url('admin') }}" class="logo"><img src="{{ asset('logo') }}/logoAlfitri.png"
                                                    alt="" class="dark-logo" style="width: 70px; height:auto; filter: contrast(1)"></a>
                                        </div>

                                        <nav>
                                            <div class="nav nav-tabs border-bottom-0" id="nav-tab" role="tablist">

                                                <div class="tab-content w-100" id="nav-tabContent">
                                                    <div class="tab-pane fade show active" id="nav-personal"
                                                        role="tabpanel" aria-labelledby="nav-personal-tab">
                                                        <form id="formLogin" method="post" class=" dz-form pb-3">
															@csrf
                                                            <h3 class="form-title m-t0">Informasi pribadi</h3>
                                                            <div class="dz-separator-outer m-b5">
                                                                <div class="dz-separator bg-primary style-liner"></div>
                                                            </div>
                                                            <p>Masukkan alamat email dan kata sandi Anda. </p>
                                                            <div class="form-group mb-3">
                                                                <input type="email" class="form-control" name="email" >
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <input type="password" class="form-control"name="password">
                                                            </div>
                                                            <div class="form-group text-left mb-5 forget-main">
                                                                <button type="submit" class="btn btn-primary" id="button_login">Masuk</button>
                                                                <span class="form-check d-inline-block">
                                                                    <input type="checkbox" class="form-check-input"
                                                                        id="check1" name="remember_me">
                                                                    <label class="form-check-label"
                                                                        for="check1">Ingat Saya</label>
                                                                </span>

                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>

                                            </div>
                                        </nav>
                                    </div>
                                    <div class="card-footer">
                                        <div class=" bottom-footer clearfix m-t10 m-b20 row text-center">
                                            <div class="col-lg-12 text-center">
                                                <span> © Copyright by <span class="heart"></span>
                                                    <a href="javascript:void(0);">AbonAlfitri </a> All rights
                                                    reserved.</span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div id="mCSB_1_scrollbar_vertical"
                                class="mCSB_scrollTools mCSB_1_scrollbar mCS-light mCSB_scrollTools_vertical"
                                style="display: block;">
                                <div class="mCSB_draggercontainer">
                                    <div id="mCSB_1_dragger_vertical" class="mCSB_dragger"
                                        style="position: absolute; min-height: 0px; display: block; height: 652px; max-height: 643px; top: 0px;">
                                        <div class="mCSB_dragger_bar" style="line-height: 0px;"></div>
                                        <div class="mCSB_draggerRail"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Full Blog Page Contant -->
        </div>
        <!-- Content END-->
    </div>

    <!--**********************************
	Scripts
***********************************-->
    <!-- Required vendors -->
    <script src="{{ asset('admin/') }}/vendor/global/global.min.js"></script>
    <script src="{{ asset('admin/') }}/vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="{{ asset('admin/') }}/js/deznav-init.js"></script>
    <script src="{{ asset('admin/') }}/js/custom.js"></script>
    <script src="{{ asset('admin/') }}/js/demo.js"></script>
    <script src="{{ asset('admin/') }}/js/styleSwitcher.js"></script>
    <script src="{{ asset('alert/js/sweetalert.js') }}"></script>

	<script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 10000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });

            function reset() {
                $("input").val('');
            }
            $("#formLogin").on('submit', function (e) {
                e.preventDefault();
                let form = $("#formLogin").serialize();
                $.ajax({
                    type: "post",
                    url: `{{ url('postLogin') }}`,
                    data: form,
                    dataType: "json",
                    beforeSend: function () {
                        $('#button_login').html("Memproses....");
                        $('#button_login').attr('disabled', true);
                    },
                    success: function (response) {
                        console.log(response)
                        $('#button_login').html("Masuk");
                        $('#button_login').removeAttr('disabled');

                        if (response.message == 1) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: 'Berhasil Login Admin!',
                            });
                            window.location.href = `{{  route('admin.dashboard') }}`;
                        } else if (response.message == 3) {
                            Toast.fire({
                                icon: 'warning',
                                title: 'User Already Login !'
                            })
                        } else if (response.message == 4) {
                            Toast.fire({
                                icon: 'error',
                                title: 'User Sudah Tidak Aktif'
                            })
                        } else if (response.message == 5) {
                            Toast.fire({
                                icon: 'warning',
                                title: 'Email Atau Password Salah !'
                            })
                        } else if (response.message == 7) { 
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: 'Berhasil Login Admin!',
                            });
                            window.location.href = `{{  route('admin.dashboard') }}`;
                        } else {
                            console.log(response)
                            Toast.fire({
                                icon: 'error',
                                title: 'Masalah Validasi !'
                            })
                        }
                    },
                    complete: function () {
                        reset();
                        $('#button_login').removeAttr('disabled');
                        $('#button_login').html("Masuk");
                    },
                    error: function (response){
                        console.log(response)
                    }
                });
            });
        });

    </script>
</body>

</html>

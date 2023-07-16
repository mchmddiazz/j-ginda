@extends('layouts.landingPage.master')
@push('title')
Abon Alfitri | LOGIN
@endpush

@push('customcss')
<style>
    body {
        overflow-y: auto;
        overflow-x: hidden;
        -webkit-overflow-scrolling: touch;
    }
</style>
@endpush

@section('content-main')
<div class="axil-breadcrumb-area">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-8">
                <div class="inner">
                    <ul class="axil-breadcrumb">
                        <li class="axil-breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="separator"></li>
                        <li class="axil-breadcrumb-item active" aria-current="page">Sign In</li>
                    </ul>
                    <h1 class="title">Sign In</h1>
                </div>
            </div>
            <div class="col-lg-6 col-md-4">
                <div class="inner">
                    <div class="bradcrumb-thumb">
                       <img src="{{ asset('logo/logoAlfitri.png') }}" alt="Image" style="height:100px;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="service-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="axil-signin-form" style="padding: 30px 0;">
                    <h3 class="title">Masuk ke Abon Alfitri.</h3>
                    <p class="b2 mb--55">Masukkan detail Anda di bawah ini</p>
                    <form class="singin-form" id="formLogin" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" placeholder="annie@example.com">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password" placeholder="">
                        </div>
                        <div class="form-group d-flex align-items-center justify-content-between">
                            <button type="submit" class="axil-btn btn-bg-primary submit-btn"
                                id="button_login">Masuk</button>
                            <a href="{{ url('/register') }}" class="forgot-btn">Belum punya akun ?</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
  
@push('customjs')
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
                url: `{{ url('/postLogin') }}`,
                data: form,
                dataType: "json",
                beforeSend: function () {
                    $('#button_login').html("Memproses....");
                    $('#button_login').attr('disabled', true);
                },
                success: function (response) {
                    $('#button_login').html("Masuk");
                    $('#button_login').removeAttr('disabled');
                    if (response.message == 2) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Berhasil Login !',
                        });
                        window.location.href = `{{  url('/') }}`;
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
                    } else if (response.message == 8) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Berhasil Login !',
                        });
                        window.location.href = `{{  url('/') }}`;
                    } else if (response.message == 6) {
                        Toast.fire({
                            icon: 'error',
                            title: response.error
                        });

                    } else {
                        console.log(response)
                        console.log("nonadmin")
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
                }
            });
        });
    });

</script>
<script type="text/javascript">
    function disableSelection(e) {
        if (typeof e.onselectstart != "undefined") e.onselectstart = function () {
            return false
        };
        else if (typeof e.style.MozUserSelect != "undefined") e.style.MozUserSelect = "none";
        else e.onmousedown = function () {
            return false
        };
        e.style.cursor = "default"
    }
    window.onload = function () {
        disableSelection(document.body)
    }

</script>
<script type="text/javascript">
    // window.addEventListener("keydown", function (e) {
    //     if (e.ctrlKey && (e.which == 65 || e.which == 66 || e.which == 67 || e.which == 73 || e.which ==
    //             80 || e.which == 83 || e.which == 85 || e.which == 86)) {
    //         e.preventDefault()
    //     }
    // });
    // document.keypress = function (e) {
    //     if (e.ctrlKey && (e.which == 65 || e.which == 66 || e.which == 67 || e.which == 73 || e.which == 80 || e
    //             .which == 83 || e.which == 85 || e.which == 86)) {}
    //     return false
    // }

</script>
<script type="text/javascript">
    // document.onkeydown = function (e) {
    //     e = e || window.event;
    //     if (e.keyCode == 123 || e.keyCode == 18) {
    //         return false
    //     }
    // }

</script>
@endpush
   
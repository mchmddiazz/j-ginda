<!doctype html>
<html class="no-js" lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>{{$title ?? "Abon Alfitri"}}</title>
	<meta name="robots" content="noindex, follow"/>
	<meta name="description" content="">

	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="viewport"
	      content="width=device-width, initial-scale=1, shrink-to-fit=no , maximum-scale=1.0, user-scalable=no">
	<!-- Favicon -->
	<link rel="shortcut icon" type="image/x-icon" href="{{ asset('logo/logoAlfitri.png')}}">

	<link href="{{ asset('alert/css/sweetalert2.css')}} " rel="stylesheet"/>
	<!-- CSS
	============================================ -->

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="{{ asset('assets/css/vendor/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{ asset('assets/css/vendor/font-awesome.css')}}">
	<link rel="stylesheet" href="{{ asset('assets/css/vendor/flaticon/flaticon.css')}}">
	<link rel="stylesheet" href="{{ asset('assets/css/vendor/slick.css')}}">
	<link rel="stylesheet" href="{{ asset('assets/css/vendor/slick-theme.css')}}">
	<link rel="stylesheet" href="{{ asset('assets/css/vendor/jquery-ui.min.css')}}">
	<link rel="stylesheet" href="{{ asset('assets/css/vendor/sal.css')}}">
	<link rel="stylesheet" href="{{ asset('assets/css/vendor/magnific-popup.css')}}">
	<link rel="stylesheet" href="{{ asset('assets/css/vendor/base.css')}}">
	<link rel="stylesheet" href="{{ asset('assets/css/style.min.css')}}">
	<link rel="stylesheet" href="{{ asset('assets/css/custom.css')}}">

	@stack('css')
</head>

<body class="sticky-header">
<a href="#top" class="back-to-top" id="backto-top"><i class="fal fa-arrow-up"></i></a>
<!-- Start Header -->
<x-landing.header></x-landing.header>
<!-- End Header -->

<main class="main-wrapper">
	{{$slot}}
</main>

<!-- Start Footer Area  -->
<x-landing.footer></x-landing.footer>
<!-- End Footer Area  -->

<x-landing.modal></x-landing.modal>


<!-- JS
    ============================================ -->
<!-- Modernizer JS -->
<script src="{{ asset('assets/js/vendor/modernizr.min.js')}}"></script>
<!-- jQuery JS -->
<script src="{{ asset('assets/js/vendor/jquery.js')}}"></script>
<!-- Bootstrap JS -->
<script src="{{ asset('assets/js/vendor/popper.min.js')}}"></script>
<script src="{{ asset('assets/js/vendor/bootstrap.min.js')}}"></script>
<script src="{{ asset('assets/js/vendor/slick.min.js')}}"></script>
<script src="{{ asset('assets/js/vendor/js.cookie.js')}}"></script>
<!-- <script src="{{ asset('assets/js/vendor/jquery.style.switcher.js')}}"></script> -->
<script src="{{ asset('assets/js/vendor/jquery-ui.min.js')}}"></script>
<script src="{{ asset('assets/js/vendor/jquery.ui.touch-punch.min.js')}}"></script>
<script src="{{ asset('assets/js/vendor/jquery.countdown.min.js')}}"></script>
<script src="{{ asset('assets/js/vendor/sal.js')}}"></script>
<script src="{{ asset('assets/js/vendor/jquery.magnific-popup.min.js')}}"></script>
<script src="{{ asset('assets/js/vendor/imagesloaded.pkgd.min.js')}}"></script>
<script src="{{ asset('assets/js/vendor/isotope.pkgd.min.js')}}"></script>
<script src="{{ asset('assets/js/vendor/counterup.js')}}"></script>
<script src="{{ asset('assets/js/vendor/waypoints.min.js')}}"></script>

<script src="{{ asset('alert/js/sweetalert.js') }}"></script>
<script>
    $(document).ready(function () {


        $(this).on('click', '#header-search-icon', function (e) {
            $("#header-search-modal").show();
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 5000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });


        $(this).on('click', '#buton_delete', function (e) {
            e.preventDefault();
            let id = $(this).data('id');
            Swal.fire({
                title: 'Peringatan',
                text: "Apakah anda yakin akan menghapus pesanan ?",
                icon: 'warning',
                showCancelButton: true,
                buttonsStyling: true,
                confirmButtonClass: 'btn btn-danger btn-lg mr-2',
                cancelButtonClass: 'btn btn-primary btn-lg',
                confirmButtonText: 'Hapus <i class="fas fa-trash"></i>',
                cancelButtonText: 'Batal <i class="fas fa-close"> </i>'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "GET",
                        url: `{{url('cart/remove')}}/${id}`,
                        data: {
                            _token: '{{csrf_token()}}'
                        },
                        dataType: "json",
                        beforeSend: function()
                        {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Mohon Tunggu !',
                                html: 'Menghapus...',// add html attribute if you want or remove
                                allowOutsideClick: false,
                                onBeforeOpen: () => {
                                    Swal.showLoading()
                                },
                            });
                        },
                        success: function (response) {

                            swal.close();
                            if (response.status == 2) {
                                Toast.fire({
                                    icon: 'warning',
                                    title: 'Silahkan Login Terlebih Dahulu'
                                });
                                window.location.href = `{{ url('/login') }}`;
                            } else {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: 'Pesanan Berhasil Dihapus !',
                                });

                                window.location.reload();
                            }
                        },
                        error: function () {

                            swal.close();
                            Toast.fire({
                                icon: 'error',
                                title: 'Gagal Menghapus Pesanan!'
                            })
                        }
                    });
                }
            })
        });

        $(this).on('click', '#buton_delete_troli', function (e) {
            e.preventDefault();
            let id = $(this).data('id');
            Swal.fire({
                title: 'Peringatan',
                text: "Apakah anda yakin akan menghapus pesanan ?",
                icon: 'warning',
                showCancelButton: true,
                buttonsStyling: true,
                confirmButtonClass: 'btn btn-danger btn-lg mr-2',
                cancelButtonClass: 'btn btn-primary btn-lg',
                confirmButtonText: 'Hapus <i class="fas fa-trash"></i>',
                cancelButtonText: 'Batal <i class="fas fa-close"> </i>'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "GET",
                        url: `{{url('cart/removeTroli')}}/${id}`,
                        data: {
                            _token: '{{csrf_token()}}'
                        },
                        dataType: "json",
                        beforeSend: function()
                        {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Mohon Tunggu !',
                                html: 'Menghapus...',// add html attribute if you want or remove
                                allowOutsideClick: false,
                                onBeforeOpen: () => {
                                    Swal.showLoading()
                                },
                            });
                        },
                        success: function (response) {
                            swal.close();
                            if (response.status == 2) {
                                Toast.fire({
                                    icon: 'warning',
                                    title: 'Silahkan Login Terlebih Dahulu'
                                });
                                window.location.href = `{{ url('/login') }}`;
                            } else {

                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: 'Pesanan Berhasil Dihapus !',
                                });
                                $('.cart-count').html(response.total);
                                $('.cartBody').html(response.body);
                                $('.cartBodyOriginal').html('');

                                $(".cart-close").on('click', function (e) {
                                    document.querySelector('.cart-dropdown')
                                        .classList.remove('open');
                                });
                            }
                        },
                        error: function () {
                            swal.close();
                            Toast.fire({
                                icon: 'error',
                                title: 'Gagal Menghapus Pesanan!'
                            })
                        }
                    });
                }
            })
        });

        $("#prod-search").on('keyup', function () {
            $value = $(this).val();
            $.ajax({
                type: "get",
                url: "{{url('search')}}",
                data: {
                    'search': $value
                },
                success: function (data) {
                    $('#bodySearch').html(data);
                }
            });
        });

        $(this).on('click', '#button_add', function (e) {
            e.preventDefault();
            let id = $(this).data('id');
            $.ajax({
                type: "get",
                url: `{{url('/product/modal')}}/${id}`,
                dataType: "json",
                success: function (response) {
                    $("#modalProductBody").html(response);
                    $('#data-modal').on('submit', function (e) {
                        e.preventDefault();
                        $('#createCart').val("Tambahkan...");
                        $('#createCart').attr('disabled', true);
                        let data = $("#data-modal").serialize();
                        let datax = new FormData(this);
                        // console.log(data[0].jenis_menu);
                        console.log(data);
                        $.ajax({
                            type: "post",
                            url: `{{url('/cart/buy')}}/${id}`,
                            data: datax,
                            dataType: "json",
                            cache: false,
                            contentType: false,
                            processData: false,
                            beforeSend: function()
                            {
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Mohon Tunggu !',
                                    html: 'Pemesanan...',// add html attribute if you want or remove
                                    allowOutsideClick: false,
                                    onBeforeOpen: () => {
                                        Swal.showLoading()
                                    },
                                });
                            },
                            success: function (response) {
                                swal.close();
                                $('#createCart').val(
                                    `Tambahkan Keranjang`);
                                $('#createCart').removeAttr('disabled');
                                $(`#quick-view-modal`).modal('hide');
                                if (response.status == 2) {
                                    Toast.fire({
                                        icon: 'warning',
                                        title: 'Silahkan Login Terlebih Dahulu'
                                    });
                                    window.location.href =
                                        `{{ url('/login') }}`;
                                } else if(response.status == 3) {
                                    Toast.fire({
                                        icon: 'warning',
                                        title: response.message
                                    });
                                } else {
                                    $('.cart-count').html(response
                                        .total);
                                    $('.cartBody').html(response.body);
                                    $('.cartBodyOriginal').html('');
                                    document.querySelector(
                                        '.cart-dropdown').classList
                                        .toggle('open');

                                    $(".cart-close").on('click',
                                        function (e) {
                                            document.querySelector(
                                                '.cart-dropdown'
                                            ).classList
                                                .remove('open');
                                        });
                                }
                            },
                            error: function (e) {
                                swal.close();
                                Toast.fire({
                                    icon: 'warning',
                                    title: 'Gagal'
                                });
                                $('#createCart').val(
                                    `Tambahkan Keranjang`);
                                $('#createCart').removeAttr('disabled');

                            }
                        });
                    });
                },
                error: function () {
                    swal.close();
                    Toast.fire({
                        icon: 'error',
                        title: 'Gagal mengambil data !'
                    })
                }
            });
        });


        $('#dataTroliBuy').on('submit', function (e) {
            e.preventDefault();
            let data = $("#dataTroliBuy").serialize();
            let datax = new FormData(this);
            $.ajax({
                type: "post",
                url: `{{url('/cart/buyButton')}}`,
                data: datax,
                dataType: "json",
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function()
                {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Mohon Tunggu !',
                        html: 'Pemesanan...',// add html attribute if you want or remove
                        allowOutsideClick: false,
                        onBeforeOpen: () => {
                            Swal.showLoading()
                        },
                    });
                },
                success: function (response) {
                    swal.close();
                    if (response.status == 2) {
                        Toast.fire({
                            icon: 'warning',
                            title: 'Silahkan Login Terlebih Dahulu'
                        });
                        window.location.href = `{{ url('/login') }}`;
                    } else if(response.status == 3) {
                        Toast.fire({
                            icon: 'warning',
                            title: response.message
                        });
                    } else {
                        $('.cart-count').html(response.total);
                        $('.cartBody').html(response.body);
                        $('.cartBodyOriginal').html('');
                        document.querySelector('.cart-dropdown').classList
                            .toggle('open');

                        $(".cart-close").on('click', function (e) {
                            document.querySelector('.cart-dropdown')
                                .classList.remove('open');
                        });
                    }
                },
                error: function (e) {
                    swal.close();
                    Toast.fire({
                        icon: 'warning',
                        title: 'Gagal'
                    });

                }
            });

        });


        $('#data-cart-add').on('submit', function (e) {
            e.preventDefault();
            let data = $("#data-cart-add").serialize();
            let datax = new FormData(this);

            console.log(data);

            $.ajax({
                type: "post",
                url: `{{url('/cart/buyButton')}}`,
                data: datax,
                dataType: "json",
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function()
                {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Mohon Tunggu !',
                        html: 'Pemesanan...',// add html attribute if you want or remove
                        allowOutsideClick: false,
                        onBeforeOpen: () => {
                            Swal.showLoading()
                        },
                    });
                },
                success: function (response) {
                    swal.close();
                    if (response.status == 2) {
                        Toast.fire({
                            icon: 'warning',
                            title: 'Silahkan Login Terlebih Dahulu'
                        });
                        window.location.href = `{{ url('/login') }}`;
                    } else if(response.status == 3) {
                        Toast.fire({
                            icon: 'warning',
                            title: response.message
                        });
                    } else {
                        $('.cart-count').html(response.total);
                        $('.cartBody').html(response.body);
                        $('.cartBodyOriginal').html('');
                        document.querySelector('.cart-dropdown').classList
                            .toggle('open');

                        $(".cart-close").on('click', function (e) {
                            document.querySelector('.cart-dropdown')
                                .classList.remove('open');
                        });
                    }
                },
                error: function (e) {
                    swal.close();
                    Toast.fire({
                        icon: 'warning',
                        title: 'Gagal'
                    });

                }
            });
        });

        $(this).on('click', '#button_create_troli_detail', function (e) {
            e.preventDefault();
            let id = $(this).data('id');
            $.ajax({
                type: "get",
                url: `{{url('/cart/buy/view')}}/${id}`,
                dataType: "json",
                beforeSend: function()
                {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Mohon Tunggu !',
                        html: 'Pemesanan...',// add html attribute if you want or remove
                        allowOutsideClick: false,
                        onBeforeOpen: () => {
                            Swal.showLoading()
                        },
                    });
                },
                success: function (response) {
                    swal.close();
                    if (response.status == 2) {
                        Toast.fire({
                            icon: 'warning',
                            title: 'Silahkan Login Terlebih Dahulu'
                        });
                        window.location.href = `{{ url('/login') }}`;
                    } else if(response.status == 3) {
                        Toast.fire({
                            icon: 'warning',
                            title: response.message
                        });
                    } else {
                        $('.cart-count').html(response.total);
                        $('.cartBody').html(response.body);
                        $('.cartBodyOriginal').html('');
                        document.querySelector('.cart-dropdown').classList
                            .toggle('open');

                        $(".cart-close").on('click', function (e) {
                            document.querySelector('.cart-dropdown')
                                .classList.remove('open');
                        });
                    }
                },
                error: function (e) {
                    swal.close();
                    Toast.fire({
                        icon: 'warning',
                        title: 'Gagal'
                    });

                }
            });
        });
    });
</script>


@stack('js')
<!-- Main JS -->
<script src="{{ asset('assets/js/main.js')}}"></script>


</body>
</html>
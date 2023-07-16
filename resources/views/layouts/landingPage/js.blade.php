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
<script type="text/javascript">
    // function disableSelection(e){if(typeof e.onselectstart!="undefined")e.onselectstart=function(){return false};else if(typeof e.style.MozUserSelect!="undefined")e.style.MozUserSelect="none";else e.onmousedown=function(){return false};e.style.cursor="default"}window.onload=function(){disableSelection(document.body)}
    </script>
    <script type="text/javascript">
    // window.addEventListener("keydown",function(e){if(e.ctrlKey&&(e.which==65||e.which==66||e.which==67||e.which==73||e.which==80||e.which==83||e.which==85||e.which==86)){e.preventDefault()}});document.keypress=function(e){if(e.ctrlKey&&(e.which==65||e.which==66||e.which==67||e.which==73||e.which==80||e.which==83||e.which==85||e.which==86)){}return false}
    </script>
    <script type="text/javascript">
    // document.onkeydown=function(e){e=e||window.event;if(e.keyCode==123||e.keyCode==18){return false}}
    </script>

@stack('customjs')
<!-- Main JS -->
<script src="{{ asset('assets/js/main.js')}}"></script>

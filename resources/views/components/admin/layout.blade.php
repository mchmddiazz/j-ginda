<!DOCTYPE html>
<html lang="en">
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

	<!-- PAGE TITLE HERE -->
	<title>{{$title ?? "Abon Alfitri"}}</title>
	<!-- FAVICONS ICON -->
	<link rel="shortcut icon" type="image/png" href="{{ asset('logo/logoAlfitri.png')}}">

	<link href="{{ asset('admin/') }}/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
{{--	<link href="{{ asset('admin/') }}/vendor/swiper/css/swiper-bundle.min.css" rel="stylesheet">--}}
{{--	<link href="{{ asset('admin/') }}/vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">--}}

{{--	<link rel="stylesheet" href="{{ asset('admin/') }}/vendor/swiper/css/swiper-bundle.min.css">--}}
{{--	<link rel="stylesheet" href="{{ asset('admin/') }}/vendor/dotted-map/css/contrib/jquery.smallipop-0.3.0.min.css"--}}
{{--	      type="text/css" media="all"/>--}}
	<link href="{{ asset('admin/') }}/vendor/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css"
	      rel="stylesheet">

	<!-- tagify-css -->
	@stack('css')
	<!-- Style css -->
	<link href="{{ asset('admin/') }}/css/style.css" rel="stylesheet">
</head>
<body>
<!--**********************************
	Main wrapper start
***********************************-->
<div id="main-wrapper" class="show">
	<!--**********************************
		Nav header start
	***********************************-->
	<div class="nav-header">
		<a href="#" class="brand-logo">
			<img src="{{ asset('logo/logoAlfitri.png')}}" alt="" style="height: 70px;  margin-left: auto;
     margin-right: auto;">

		</a>
		<div class="nav-control">
			<div class="hamburger">
				<span class="line"></span><span class="line"></span><span class="line"></span>
			</div>
		</div>
	</div>
	<!--**********************************
			Nav header end
		***********************************-->

	<!--**********************************
		Header start
	***********************************-->
	<x-admin.header></x-admin.header>
	<!--**********************************
			Header end ti-comment-alt
		***********************************-->

	<!--**********************************
		Sidebar start
	***********************************-->
	<x-admin.sidebar></x-admin.sidebar>

	<!--**********************************
			Sidebar end
		***********************************-->

	<!--**********************************
		Content body start
	***********************************-->
	<div class="content-body">
		<div class="container">
			<x-admin.alert></x-admin.alert>
			{{ $slot }}
		</div>
	</div>
	<!--**********************************
		Content body end
	***********************************-->

	<x-admin.footer></x-admin.footer>
</div>
<!--**********************************
	Main wrapper end
***********************************-->

<!--**********************************
	Scripts
***********************************-->
<!-- Required vendors -->
<script src="{{ asset('admin') }}/vendor/global/global.min.js"></script>
<script src="{{ asset('admin') }}/vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>

<!-- Dashboard 1 -->
<script src="{{ asset('admin') }}/vendor/swiper/js/swiper-bundle.min.js"></script>

@stack('js')

<!-- Vectormap -->
<script src="{{ asset('admin') }}/js/custom.js"></script>
{{--<script src="{{ asset('admin') }}/js/deznav-init.js"></script>--}}
{{--<script src="{{ asset('admin') }}/js/demo.js"></script>--}}
{{--<script src="{{ asset('admin') }}/js/styleSwitcher.js"></script>--}}

<script>
    // var swiper = new Swiper(".mySwiper", {
    //     slidesPerView: 5,
    //     //spaceBetween: 30,
    //     pagination: {
    //         el: ".swiper-pagination",
    //         clickable: true,
    //     },
    //     breakpoints: {
	//
    //         300: {
    //             slidesPerView: 1,
    //             spaceBetween: 20,
    //         },
    //         416: {
    //             slidesPerView: 2,
    //             spaceBetween: 20,
    //         },
    //         768: {
    //             slidesPerView: 3,
    //             spaceBetween: 20,
    //         },
    //         1280: {
    //             slidesPerView: 4,
    //             spaceBetween: 10,
    //         },
    //         1788: {
    //             slidesPerView: 5,
    //             spaceBetween: 20,
    //         },
    //     },
    // });
</script>
</body>
</html>
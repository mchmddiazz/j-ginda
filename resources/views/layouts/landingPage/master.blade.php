<!doctype html>
<html class="no-js" lang="en">

@include('layouts.landingPage.head')


<body class="sticky-header">
  <a href="#top" class="back-to-top" id="backto-top"><i class="fal fa-arrow-up"></i></a>
    <!-- Start Header -->
    @include('layouts.landingPage.header')
    <!-- End Header -->

    <main class="main-wrapper">
      @yield('content-main')

    </main>

    <!-- Start Footer Area  -->
    @include('layouts.landingPage.footer')
    <!-- End Footer Area  -->

    @include('layouts.landingPage.modal')

    
    @include('layouts.landingPage.js')

</body>
</html>
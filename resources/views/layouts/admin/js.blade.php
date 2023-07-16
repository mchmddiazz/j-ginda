 <!-- Required vendors -->
 <script src="{{ asset('admin') }}/vendor/global/global.min.js"></script>
 <script src="{{ asset('admin') }}/vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
 
 <!-- Dashboard 1 -->
 <script src="{{ asset('admin') }}/vendor/swiper/js/swiper-bundle.min.js"></script>
 
 
 <!-- JS for dotted map -->
 <script src="{{ asset('admin') }}/vendor/dotted-map/js/contrib/jquery.smallipop-0.3.0.min.js"></script>
 <script src="{{ asset('admin') }}/vendor/dotted-map/js/contrib/suntimes.js"></script>
 <script src="{{ asset('admin') }}/vendor/dotted-map/js/contrib/color-0.4.1.js"></script>
 
 <script src="{{ asset('admin') }}/vendor/dotted-map/js/world.js"></script>

 <!-- Apex Chart -->
 
 @stack('js')

 <!-- Vectormap -->
 <script src="{{ asset('admin') }}/js/custom.js"></script>
 <script src="{{ asset('admin') }}/js/deznav-init.js"></script>
 <script src="{{ asset('admin') }}/js/demo.js"></script>
 <script src="{{ asset('admin') }}/js/styleSwitcher.js"></script>
 
   <script>
     var swiper = new Swiper(".mySwiper", {
       slidesPerView: 5,
       //spaceBetween: 30,
       pagination: {
         el: ".swiper-pagination",
         clickable: true,
       },
       breakpoints: {
         
       300: {
         slidesPerView: 1,
         spaceBetween: 20,
       },
       416: {
         slidesPerView: 2,
         spaceBetween: 20,
       },
        768: {
         slidesPerView: 3,
         spaceBetween: 20,
       },
        1280: {
         slidesPerView: 4,
         spaceBetween: 10,
       },
       1788: {
         slidesPerView: 5,
         spaceBetween: 20,
       },
     },
     });
</script>
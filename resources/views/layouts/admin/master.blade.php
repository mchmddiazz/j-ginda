<!DOCTYPE html>
<html lang="en">

@include('layouts.admin.head')
	
</head>
<body>

    <!--*******************
        Preloader start
    ********************-->
    <!-- <div id="preloader">
		<div class="loader-wrapper">
			<div class="loader-box">
				<div class="icon">
				  <i class="fas fa-utensils"></i>
				</div>
			</div>
		</div>
	</div>	 -->
	@include('layouts.admin.preloader')
	
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">
        <!--**********************************
            Nav header start
        ***********************************-->
        @include('layouts.admin.nav-header')
        <!--**********************************
            Nav header end
        ***********************************-->
		
		<!--**********************************
            Chat box start
        ***********************************-->
		@include('layouts.admin.chatbox')
		<!--**********************************
            Chat box End
        ***********************************-->
		
		<!--**********************************
            Header start
        ***********************************-->
		@include('layouts.admin.header')
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
		@include('layouts.admin.sidebar')
		
        <!--**********************************
            Sidebar end
        ***********************************-->
		
		<!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
			<div class="container">
                @yield('content')
			</div>
		
		</div>
		<div class="modal fade" id="exampleModal1" tabindex="-1"  aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
				  <div class="modal-header ">
					<h5 class="modal-title">Add Customer</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				  </div>
				  <div class="modal-body">
					 <div class="form-group">
						<label class="form-label">Seller Mobile Number</label>
						<input type="number" class="form-control mb-3" id="exampleInputEmail1"  placeholder="Number">
						<label class="form-label">Email</label>
						<input type="email" class="form-control mb-3" id="exampleInputEmail2"  placeholder=" Email">
						<label class="form-label">Amount</label>
						<input type="number" class="form-control mb-3" id="exampleInputEmail3"  placeholder="Amount">
					  </div>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary">Save changes</button>
				  </div>
				</div>
			</div>
		</div>
        <!--**********************************
            Content body end
        ***********************************-->
		
        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
               <p>Copyright © Developed by <a href="#" target="_blank">Abon Alfitri</a> 2023</p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->

		<!--**********************************
           Support ticket button start
        ***********************************-->
		
        <!--**********************************
           Support ticket button end
        ***********************************-->


	</div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
   @include('layouts.admin.js')
	
	
	
</body>
</html>
<x-landing.layout>
	<div class="axil-breadcrumb-area">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-lg-6 col-md-8">
					<div class="inner">
						<ul class="axil-breadcrumb">
							<li class="axil-breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
							<li class="separator"></li>
							<li class="axil-breadcrumb-item active" aria-current="page">Register</li>
						</ul>
						<h1 class="title">Register</h1>
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
					<div class="mt-4">
						<x-admin.alert></x-admin.alert>
					</div>

					<div class="axil-signin-form" style="padding: 30px 0;">
						<form class="singin-form" id="data-master" method="POST" action="{{route('registration')}}">
							@csrf
							<div class="form-group">
								<label>Nama</label>
								<input type="text" class="form-control" name="name">
							</div>
							<div class="form-group">
								<label>Email</label>
								<input type="email" class="form-control" name="email">
							</div>
							<div class="form-group">
								<label>Password</label>
								<input type="password" class="form-control" name="password">
							</div>
							<div class="form-group">
								<label>Konfirmasi Password</label>
								<input type="password" class="form-control" name="password_confirmation">
							</div>

							<hr style="border: 1px solid;">

							<h3 class="b2 mb--55 title">Alamat</h3>
							<p class="b2 mb--55">Masukkan detail alamat di bawah ini</p>

							<div class="form-group">
								<label>Alamat</label>
								<input type="text" class="form-control" name="address">
							</div>
							<div class="form-group">
								<label>Kode Pos</label>
								<input type="text" class="form-control" name="postal_code">
							</div>
							<div class="form-group">
								<label>No Telepon</label>
								<input type="text" class="form-control" name="phone">
							</div>

							<div class="form-group">
								<button type="submit" class="axil-btn btn-bg-primary submit-btn" style="width: 100%;"
								        id="simpan-data">
									Buat Akun
								</button>
								<a href="{{ route('login') }}" class="axil-btn btn-bg-primary forgot-btn"
								   style="margin-top: 15px; width: 100%; text-align: center;">Sudah punya akun ?</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</x-landing.layout>


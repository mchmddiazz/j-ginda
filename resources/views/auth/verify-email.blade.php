<x-landing.layout>
	@push('css')
		<style>
            body {
                overflow-y: auto;
                overflow-x: hidden;
                -webkit-overflow-scrolling: touch;
            }
		</style>
	@endpush

	<div class="axil-breadcrumb-area">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-lg-6 col-md-8">
					<div class="inner">
						<h1 class="title">Verifikasi Email</h1>
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

					<div class="verify-email" style="margin-bottom: 30px;">
						<h3 class="title">Email anda belum terverifikasi !</h3>
						<p class="b2 mb--55">Kirim Ulang Verifikasi</p>
						<div class="col">
							<form action="{{route('verification.send')}}" method="POST" class="d-inline-block">
								@csrf
								<button class="btn btn-primary">Kirim Ulang Verifikasi</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</x-landing.layout>

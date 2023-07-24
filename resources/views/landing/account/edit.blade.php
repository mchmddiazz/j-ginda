<x-landing.layout>

	<!-- Start Breadcrumb Area  -->
	<div class="axil-breadcrumb-area">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-lg-6 col-md-8">
					<div class="inner">
						<ul class="axil-breadcrumb">
							<li class="axil-breadcrumb-item"><a href="#">Home</a></li>
							<li class="separator"></li>
							<li class="axil-breadcrumb-item active" aria-current="page">Akun</li>
						</ul>
						<h1 class="title">Akun</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Breadcrumb Area  -->

	<!-- Start My Account Area  -->
	<div class="axil-dashboard-area axil-section-gap">
		<div class="container">
			<div class="axil-dashboard-warp">
				<div class="axil-dashboard-author">
					<div class="media">
						<div class="thumbnail">
							<img
									src="https://avataaars.io/?avatarStyle=Transparent&topType=Hat&accessoriesType=Kurt&facialHairType=Blank&clotheType=BlazerShirt&eyeType=Default&eyebrowType=Default&mouthType=Default&skinColor=Brown">
						</div>
						<div class="media-body">
							<h5 class="title mb-0">Hello {{ $user->name }}</h5>
							<span class="joining-date">
								Anggota Alfitri Sejak {{ $user->created_at->format('d M Y') }}
							</span>
						</div>
					</div>
				</div>
				<div class="row">
					<x-admin.alert></x-admin.alert>

					<div class="col-xl-3 col-md-4">
						<aside class="axil-dashboard-aside">
							<nav class="axil-dashboard-nav">
								<div class="nav nav-tabs" role="tablist">
									<a class="nav-item nav-link active" data-bs-toggle="tab" href="#nav-dashboard"
									   role="tab" aria-selected="true"><i class="fas fa-th-large"></i>Dashboard</a>
									<a class="nav-item nav-link" data-bs-toggle="tab" href="#nav-orders" role="tab"
									   aria-selected="false"><i class="fas fa-shopping-basket"></i>Pesanan</a>
									<a class="nav-item nav-link" data-bs-toggle="tab" href="#nav-account" role="tab"
									   aria-selected="false"><i class="fas fa-user"></i>Detail akun</a>
									<a class="nav-item nav-link" href="{{ route('logout') }}"><i
												class="fal fa-sign-out"></i>Logout</a>
								</div>
							</nav>
						</aside>
					</div>
					<div class="col-xl-9 col-md-8">
						<div class="tab-content">
							<div class="tab-pane fade show active" id="nav-dashboard" role="tabpanel">
								<div class="axil-dashboard-overview">
									<div class="welcome-text">Hai {{ $user->name }} (Bukan
										<span>{{ $user->name }}?</span> <a href="{{ url('/logout') }}">
											Log Out
										</a>)
									</div>
									<p>Dari dasbor akun, Anda dapat melihat pesanan terbaru, serta mengedit kata sandi
										dan
										detail akun.</p>
								</div>
							</div>
							<div class="tab-pane fade" id="nav-orders" role="tabpanel">
								<div class="axil-dashboard-order">
									<div class="table-responsive">
										<table class="table">
											<thead>
											<tr>
												<th scope="col">Order</th>
												<th scope="col">Nomor Resi</th>
												<th scope="col">Tanggal</th>
												<th scope="col">Status</th>
												<th scope="col">Total Harga</th>
												<th scope="col">Aksi</th>
												<th></th>
											</tr>
											</thead>
											<tbody>
											@foreach ($orders as $order)
												<tr>
													<th scope="row">{{ $order->order_number }}</th>
													<th>{{ $order->tracking_number ?? "-" }}</th>
													<td>{{ $order->created_at->format('d M Y H:i') }}</td>
													<td>{{$order->payment_status}}</td>
													<td>{{ formatToRupiah($order->grand_total) }} </td>
													<td>
														<a href="{{ route('orders.show', $order->id) }}"
														   class="axil-btn view-btn">
															View
														</a>
													</td>
													<td>
														@if ($order->payment_status == 2)
															<a href="#" data-id="{{ $order->id }}"
															   data-order="{{ $order->order_number }}"
															   class="axil-btn view-btn" id="buton_generate"><i
																		class="fas fa-download"></i> Invoice</a>
														@elseif ($order->payment_status == 5)
															<a href="#" data-id="{{ $order->id }}"
															   data-order="{{ $order->order_number }}"
															   class="axil-btn view-btn" id="buton_generate"><i
																		class="fas fa-download"></i> Invoice</a>
														@endif    </td>
												</tr>
											@endforeach
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<div class="tab-pane fade" id="nav-downloads" role="tabpanel">
								<div class="axil-dashboard-order">
									<p>You don't have any download</p>
								</div>
							</div>
							<div class="tab-pane fade" id="nav-account" role="tabpanel">
								<div class="col-lg-9">
									<div class="axil-dashboard-account">
										<form class="account-details-form" action="{{ route('account.update') }}"
										      method="POST">
											@csrf
											@method('PATCH')
											@foreach ($errors->all() as $error)
												<p class="text-danger">{{ $error }}</p>
											@endforeach
											<div class="row">
												<div class="col-lg-12">
													<div class="form-group">
														<label>Nama Lengkap</label>
														<input type="text" class="form-control"
														       value="{{ $user->name }}"
														       id="name" name="name" disabled>
													</div>
												</div>
												<div class="col-12">
													<h5 class="title">Perubahan Kata Sandi</h5>
													<div class="form-group">
														<label>Kata sandi</label>
														<input type="password" class="form-control" name="password"
														       autocomplete="current-password">
													</div>
													<div class="form-group">
														<label>Kata sandi baru</label>
														<input type="password" class="form-control" name="new_password"
														       autocomplete="current-password">
													</div>
													<div class="form-group">
														<label>Konfirmasi Kata Sandi baru</label>
														<input type="password" class="form-control"
														       name="new_password_confirmation"
														       autocomplete="current-password">
													</div>
													<div class="form-group mb--0">
														<input type="submit" class="axil-btn" value="Save Changes"
														       id="buttonSave">
													</div>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End My Account Area  -->

	@push('js')
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

                $(this).on('click', '#buton_generate', function (e) {
                    e.preventDefault();
                    let id = $(this).data('id');
                    let order = $(this).data('order');
                    var data = '';
                    Swal.fire({
                        title: 'Notifikasi',
                        text: "Apakah anda yakin akan men-generate invoice ini ?",
                        icon: 'question',
                        showCancelButton: true,
                        buttonsStyling: true,
                        confirmButtonClass: 'btn btn-danger btn-lg mr-2',
                        cancelButtonClass: 'btn btn-primary btn-lg',
                        confirmButtonText: 'Generate <i class="fas fa-download"></i>',
                        cancelButtonText: 'Batal <i class="fas fa-close"> </i>'
                    }).then((result) => {
                        if (result.value) {
                            $.ajax({
                                type: "GET",
                                url: `{{url('account/invoice/generate')}}/${id}`,
                                data: data,
                                xhrFields: {
                                    responseType: 'blob'
                                },
                                beforeSend: function () {
                                    Swal.fire({
                                        icon: 'warning',
                                        title: 'Mohon Tunggu !',
                                        html: 'Proses Generate...',// add html attribute if you want or remove
                                        allowOutsideClick: false,
                                        onBeforeOpen: () => {
                                            Swal.showLoading()
                                        },
                                    });
                                },
                                success: function (response) {

                                    swal.close();
                                    var blob = new Blob([response]);

                                    var link = document.createElement('a');

                                    link.href = window.URL.createObjectURL(blob);

                                    link.download = `invoice-${order}.pdf`;

                                    link.click();

                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil',
                                        text: 'Data Berhasil Digenerate !',
                                    });
                                },
                                error: function (blob) {

                                    swal.close();
                                    console.log(blob);

                                }
                            });
                        }
                    })
                });
            });
		</script>
	@endpush
</x-landing.layout>




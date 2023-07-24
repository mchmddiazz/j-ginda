@php use App\Enums\OrderStatus; @endphp
<x-admin.layout>

	<div class="row">
		<!-- Column  -->
		<div class="col-lg-12">
			<div class="card dz-card">
				<div class="card-header flex-wrap border-0" id="default-tab">
					<h4 class="card-title">Order</h4>
				</div>
				<div class="card-body pt-0">

					<ul class="nav nav-tabs">
						<li class="nav-item">
							<a class="nav-link {{ request()->fullUrl() === route('admin.orders.index', ['status' => 'all']) || request()->fullUrl() === route('admin.orders.index') ? 'active' : '' }}"
							   href="{{route('admin.orders.index', ['status' => 'all'])}}">Semua Order</a>
						</li>
						<li class="nav-item">
							<a class="nav-link {{ request()->fullUrl() === route('admin.orders.index', ['status' => 'pending']) ? 'active' : '' }}"
							   href="{{route('admin.orders.index', ['status' => 'pending'])}}">Pending</a>
						</li>
						<li class="nav-item">
							<a class="nav-link {{ request()->fullUrl() === route('admin.orders.index', ['status' => 'processing']) ? 'active' : '' }}"
							   href="{{route('admin.orders.index', ['status' => 'processing'])}}">Processing</a>
						</li>
						<li class="nav-item">
							<a class="nav-link {{ request()->fullUrl() === route('admin.orders.index', ['status' => 'completed']) ? 'active' : '' }}"
							   href="{{route('admin.orders.index', ['status' => 'completed'])}}">Completed</a>
						</li>
						<li class="nav-item">
							<a class="nav-link {{ request()->fullUrl() === route('admin.orders.index', ['status' => 'decline']) ? 'active' : '' }}"
							   href="{{route('admin.orders.index', ['status' => 'decline'])}}">Decline</a>
						</li>
					</ul>
					@if($orders->count()===0)
						<x-admin.empty-data></x-admin.empty-data>
					@else
						<div class="pt-4">
							<div class="table-responsive">
								<table class="table" width="100%">
									<thead>
									<tr>
										<th>No</th>
										<th>Order Number</th>
										<th>Pelanggan</th>
										<th>Total Harga</th>
										<th>Jumlah</th>
										@if(request()->query("status", "") === OrderStatus::COMPLETED())
											<th>Nomor Resi</th>
										@endif
										<th>Status</th>
										<th>Bukti Pembayaran</th>
										<th>Tanggal</th>
										<th>Aksi</th>
									</tr>
									</thead>
									<tbody>
									@foreach($orders as $key => $order)
										<tr>
											<td>{{$orders->firstItem()+$key}}</td>
											<td>{{$order->order_number}}</td>
											<td>{{$order->user?->name}}</td>
											<td>{{ formatToRupiah($order->grand_total)}}</td>
											<td>{{"$order->item_count order"}}</td>
											@if(request()->query("status", "") === OrderStatus::COMPLETED())
												<td>{{$order->tracking_number}}</td>
											@endif
											<td>
												@if($order->status === OrderStatus::PENDING())
													<span class="badge bg-warning">Tertunda</span>
												@elseif($order->status === OrderStatus::DECLINE())
													<span class="badge bg-danger">Ditolak</span>
												@elseif($order->status === OrderStatus::PROCESSING())
													<span class="badge bg-primary">Diproses</span>
												@elseif($order->status === OrderStatus::COMPLETED())
													<span class="badge bg-success">Selesai</span>
											@endif
											<td>
												@if($order->image && $order->image!== '')
													<a href="{{asset('storage/payments/'.$order->image)}}">
														<img height="100px"
														     src="{{asset('storage/payments/'.$order->image)}}">
													</a>
												@else
													Belum Bayar
												@endif
											</td>
											<td>{{$order->created_at}}</td>
											<td>
												<div class="d-grid gap-2 d-md-block">
													<a href="{{route('admin.orders.show', $order->id)}}"
													   class="btn btn-primary btn-sm" type="button">Detail</a>
													@if($order->status === OrderStatus::PENDING())
														<button class="btn btn-success btn-sm btn-accept"
														        data-id="{{$order->id}}" data-status="processing"
														        type="button">Terima Pembayaran
														</button>
														<button class="btn btn-danger btn-sm btn-decline"
														        data-id="{{$order->id}}" data-status="decline"
														        type="button">Tolak Pesanan
														</button>
													@endif

													@if($order->status === OrderStatus::PROCESSING())
														<button type="button"
														        class="btn btn-success btn-sm btn-completed"
														        data-bs-toggle="modal" data-id="{{$order->id}}"
														        data-status="completed"
														        data-bs-target="#completed-payment">
															Kirim Pesanan
														</button>
													@endif
												</div>
											</td>
										</tr>
									@endforeach
									</tbody>
								</table>
								{{$orders->withQueryString()->links()}}
							</div>
						</div>
					@endif
				</div>
			</div>
		</div>
	</div>


	<!-- Modal -->
	<div class="modal fade" id="completed-payment" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Kirim Pesanan</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form id="form-status-completed"
					      action="{{route('admin.orders.update.payment.status', [':id', ':status']) }}" method="POST">
						@csrf
						@method('PATCH')
						<div class="mb-3">
							<label for="nomor-resi" class="form-label">Nomor Resi</label>
							<input type="text" class="form-control" id="nomor-resi" placeholder="Masukkan nomor resi"
							       name="tracking_number">
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batalkan</button>
					<button type="submit" form="form-status-completed" class="btn btn-success">Konfirmasi</button>
				</div>
			</div>
		</div>
	</div>

	<form id="form-update-status-payment" action="{{route('admin.orders.update.payment.status', [':id', ':status']) }}"
	      class="d-none" method="POST">
		@csrf
		@method("PATCH")
	</form>

	@push("js")
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
		<script>
            function alertConfirm(successCallback, newConfig) {
                let config = {
                    title: 'Apakah anda yakin ?',
                    text: "Aksi tidak dapat dibatalkan !",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, konfirmasi !',
                    cancelButtonText: 'Batalkan !'
                };

                if (newConfig != undefined) {
                    config = {...config, ...newConfig}
                }

                Swal.fire(config).then((result) => {
                    if (result.isConfirmed && typeof successCallback == "function") {
                        successCallback();
                    }
                })
            }

            let defaultUpdateStatusPaymentUrl = $("#form-update-status-payment").attr("action");

            $(".btn-accept").on("click", function () {
                const id = $(this).data("id");
                const status = $(this).data("status");
                let newUrl = defaultUpdateStatusPaymentUrl.replace(":id", id).replace(":status", status);
                $("#form-update-status-payment").attr("action", newUrl);

                alertConfirm(() => {
                    $("#form-update-status-payment").trigger("submit");
                })
            });

            $(".btn-decline").on("click", function () {
                const id = $(this).data("id");
                const status = $(this).data("status");
                let newUrl = defaultUpdateStatusPaymentUrl.replace(":id", id).replace(":status", status);
                $("#form-update-status-payment").attr("action", newUrl);

                alertConfirm(() => {
                    $("#form-update-status-payment").trigger("submit");
                })
            });

            $(".btn-completed").on("click", function () {
                const id = $(this).data("id");
                const status = $(this).data("status");
                let newUrl = defaultUpdateStatusPaymentUrl.replace(":id", id).replace(":status", status);
                $("#form-status-completed").attr("action", newUrl);
            });


		</script>
	@endpush

</x-admin.layout>
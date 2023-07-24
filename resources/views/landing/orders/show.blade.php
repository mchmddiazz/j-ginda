@php use App\Enums\PaymentStatusEnum; @endphp
<x-landing.layout>
	<div class="axil-product-cart-area axil-section-gap">
		<div class="container">
			<div class="row">
				<x-admin.alert></x-admin.alert>
				<div class="col-12 col-md-8">
					<div class="card shadow-lg p-3 mb-5 bg-body rounded">
						<div class="card-header">
							<h5>Data Order</h5>
						</div>
						<div class="table-responsive">
							<table class="table axil-product-table" id="tableOrders">
								<tr>
									<td>ID</td>
									<td><b>#{{ $order->order_number }}</b></td>
								</tr>
								<tr>
									<td>Total Harga</td>
									<td><b>{{ formatToRupiah($order->grand_total) }}</b></td>
								</tr>
								<tr>
									<td>Status Pembayaran</td>
									<td>
										<b>
											{{ucwords($order->payment_status)}}
										</b>
									</td>
								</tr>
								<tr>
									<td>Tanggal</td>
									<td><b>{{ $order->created_at->format('d M Y H:i') }}</b></td>
								</tr>
							</table>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-4">
					<div class="card shadow-lg p-3 mb-5 bg-body rounded">
						<div class="card-header">
							<h5>Pembayaran</h5>
						</div>
						<div class="card-body">
							@if($order->payment_status === PaymentStatusEnum::PAID())
								Lunas
							@elseif($order->payment_status === PaymentStatusEnum::EXPIRED())
								Kadaluarsa
							@elseif($order->payment_status === PaymentStatusEnum::COD())
								Bayar Ditempat
							@elseif($order->payment_status === PaymentStatusEnum::WAITING())
								<!-- Button trigger modal -->
								<button type="button" class="btn btn-primary" data-bs-toggle="modal"
								        data-bs-target="#exampleModal">
									Bayar
								</button>

								<!-- Modal -->

							@endif
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="exampleModal" tabindex="-1"
	     aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Bayar Pesanan</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"
					        aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form id="update" action="{{ route('orders.update', $order->id) }}" method="POST" enctype="multipart/form-data">
						@csrf
						@method('PATCH')
						<div class="mb-3">
							<label for="image" class="form-label">Bukti Pembayaran</label>
							<input class="form-control" type="file" id="image" name="image" required>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button form="update" type="submit" class="btn btn-primary">Konfirmasi Pembayaran</button>
				</div>
			</div>
		</div>
	</div>
</x-landing.layout>



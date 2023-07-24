@php use Illuminate\Support\Facades\Auth; @endphp
<x-admin.layout>

	<div class="row">
		<!-- Column  -->
		<div class="col-lg-12">
			<div class="card dz-card">
				<div class="card-header flex-wrap border-0" id="default-tab">
					<h4 class="card-title">Order</h4>
				</div>
				<div class="card-body pt-0">
					<div class="p-4">
						<div class="row g-3">
							<h4>Pesanan</h4>
							<div class="col-md-6">
								<label class="form-label">Order Number</label>
								<input type="text" class="form-control" readonly value="{{$order->order_number}}">
							</div>
							<div class="col-md-6">
								<label class="form-label">Total Harga Pesanan</label>
								<input type="text" class="form-control" readonly
								       value="{{ formatToRupiah($order->grand_total) }}">
							</div>
							<div class="col-md-6">
								<label class="form-label">Jumlah Item Pesanan</label>
								<input type="text" class="form-control" readonly value="{{ $order->item_count }}">
							</div>
							<div class="col-md-6">
								<label class="form-label">Status Pembayaran</label>
								<input type="text" class="form-control" readonly value="{{ ucwords($order->status)}}">
							</div>
							<hr>
							<h4>Informasi Pembeli</h4>
							<div class="col-md-4">
								<label class="form-label">Nama</label>
								<input type="text" class="form-control" readonly
								       @if($order->is_custom_address)
									       value="{{ $order->name ?? "-" }}"
								       @else
									       value="{{ Auth::user()->name ?? "-" }}"
										@endif
								>
							</div>
							<div class="col-md-4">
								<label class="form-label">Email</label>
								<input type="text" class="form-control" readonly
								       value="{{ Auth::user()->email ?? "-" }}">
							</div>
							<div class="col-md-4">
								<label class="form-label">Nomor HP</label>
								<input type="text" class="form-control" readonly
								       @if($order->is_custom_address)
									       value="{{ $order->phone_number ?? "-" }}"
								       @else
									       value="{{ Auth::user()->phone_number ?? "-" }}"
										@endif
								>
							</div>
							<hr>

							<h4>Informasi Alamat</h4>
							<div class="col-md-4">
								<label class="form-label">Provinsi</label>
								<input type="text" class="form-control" readonly
								       @if($order->is_custom_address)
									       value="{{ $order->city?->province?->name ?? "-" }}"
								       @else
									       value="{{ Auth::user()->city?->province?->name ?? "-" }}"
										@endif
								>
							</div>
							<div class="col-md-4">
								<label class="form-label">Kabupaten/Kota</label>
								<input type="text" class="form-control" readonly
								       @if($order->is_custom_address)
									       value="{{ $order->city?->name ?? "-" }}"
								       @else
									       value="{{ Auth::user()->city?->name ?? "-" }}"
										@endif
								>
							</div>
							<div class="col-md-4">
								<label class="form-label">Kode Post</label>
								<input type="text" class="form-control" readonly
								       @if($order->is_custom_address)
									       value="{{ $order->postal_code ?? "-" }}"
								       @else
									       value="{{ Auth::user()->postal_code ?? "-" }}"
										@endif
								>
							</div>
							<div class="col-md-12">
								<label class="form-label">Alamat</label>
								<textarea class="form-control" readonly>  @if($order->is_custom_address){{ $order->address?? "-" }} @else {{Auth::user()->address}}@endif</textarea>
							</div>
							<hr>
							<h4>Ekspedisi Pengiriman</h4>
							<div class="col-md-6">
								<label class="form-label">Expedisi</label>
								<textarea class="form-control" readonly>{{$order->expedisi}}</textarea>
							</div>
							<div class="col-md-6">
								<label class="form-label">Total Berat</label>
								<input type="text" class="form-control" readonly value="{{ "$order->weight grams" }}">
							</div>
							<div class="col-md-6">
								<label class="form-label">Nomor Resi</label>
								<input type="text" class="form-control" readonly
								       value="{{ $order->tracking_number ?? "-" }}">
							</div>
							<div class="col-md-6">
								<label class="form-label">Ongkos Kirim</label>
								<input type="text" class="form-control" readonly
								       value="{{ formatToRupiah($order->ongkir) ?? 0 }}">
							</div>
							<div class="col-md-6">
								<label class="form-label">Catatan</label>
								<input type="text" class="form-control" readonly value="{{ $order->notes }}">
							</div>
							<div class="col-md-6">
								<label class="form-label">Tanggal Pesanan Dibuat</label>
								<input type="text" class="form-control" readonly value="{{ $order->created_at }}">
							</div>
							<hr>

						</div>
						<a href="{{route('admin.orders.index')}}" class="btn btn-secondary btn-sm"
						   type="button">Kembali</a>
					</div>
				</div>
			</div>
		</div>
	</div>

</x-admin.layout>
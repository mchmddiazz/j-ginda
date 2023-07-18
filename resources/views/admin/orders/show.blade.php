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
							<div class="col-md-4">
								<label class="form-label">Order Number</label>
								<input type="text" class="form-control" readonly value="{{$order->order_number}}">
							</div>
							<div class="col-md-4">
								<label class="form-label">Total Harga Pesanan</label>
								<input type="text" class="form-control" readonly
								       value="{{ formatToRupiah($order->grand_total) }}">
							</div>
							<div class="col-md-4">
								<label class="form-label">Jumlah Item Pesanan</label>
								<input type="text" class="form-control" readonly value="{{ $order->item_count }}">
							</div>
							<div class="col-md-6">
								<label class="form-label">Status Pembayaran</label>
								<input type="text" class="form-control" readonly value="{{ ucwords($order->status)}}">
							</div>
							<div class="col-md-6">
								<label class="form-label">Metode Pembayaran</label>
								<input type="text" class="form-control" readonly
								       value="{{ $order->payment_method ?? "-" }}">
							</div>
							<hr>
							<h4>Informasi Pembeli</h4>
							<div class="col-md-6">
								<label class="form-label">Nama Depan</label>
								<input type="text" class="form-control" readonly
								       value="{{ $order->first_name ?? "-" }}">
							</div>
							<div class="col-md-6">
								<label class="form-label">Nama Belakang</label>
								<input type="text" class="form-control" readonly value="{{ $order->last_name ?? "-" }}">
							</div>
							<div class="col-md-4">
								<label class="form-label">Email</label>
								<input type="text" class="form-control" readonly value="{{ $order->email }}">
							</div>
							<div class="col-md-4">
								<label class="form-label">Nomor HP</label>
								<input type="text" class="form-control" readonly
								       value="{{ $order->phone_number ?? "-" }}">
							</div>
							<div class="col-md-4">
								<label class="form-label">Perusahaan</label>
								<input type="text" class="form-control" readonly value="{{ $order->company ?? "-" }}">
							</div>
							<hr>

							<h4>Informasi Alamat</h4>
							<div class="col-md-4">
								<label class="form-label">Provinsi</label>
								<input type="text" class="form-control" readonly
								       value="{{ $order->province?->name ?? "-" }}">
							</div>
							<div class="col-md-4">
								<label class="form-label">Kabupaten/Kota</label>
								<input type="text" class="form-control" readonly
								       value="{{ $order->city?->name ?? "-" }}">
							</div>
							<div class="col-md-4">
								<label class="form-label">Kode Post</label>
								<input type="text" class="form-control" readonly value="{{ $order->post_code ?? "-" }}">
							</div>
							<div class="col-md-6">
								<label class="form-label">Alamat</label>
								<textarea class="form-control" readonly>{{$order->address}}</textarea>
							</div>
							<div class="col-md-6">
								<label class="form-label">Alamat 2</label>
								<textarea class="form-control" readonly>{{$order->address2}}</textarea>
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
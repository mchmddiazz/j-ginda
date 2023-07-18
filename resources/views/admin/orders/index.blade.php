<x-admin.layout>

	<div class="row">
		<!-- Column  -->
		<div class="col-lg-12">
			<div class="card dz-card">
				<div class="card-header flex-wrap border-0" id="default-tab">
					<h4 class="card-title">Order</h4>
				</div>
				@if($orders->count()===0)
					<x-admin.empty-data></x-admin.empty-data>
				@else
					<div class="card-body pt-0">
						<div class="table-responsive">
							<table class="table" width="100%">
								<thead>
								<tr>
									<th>No</th>
									<th>Order Number</th>
									<th>Pelanggan</th>
									<th>Total Harga</th>
									<th>Jumlah</th>
									<th>Status</th>
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
										<td>{{$order->status}}</td>
										<td>{{$order->created_at}}</td>
									</tr>
								@endforeach
								</tbody>
							</table>
						</div>
					</div>
				@endif
			</div>
		</div>
	</div>

</x-admin.layout>
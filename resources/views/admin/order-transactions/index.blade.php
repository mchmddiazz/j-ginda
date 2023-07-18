<x-admin.layout>
	<div class="row">
		<!-- Column  -->
		<div class="col-lg-12">
			<div class="card dz-card">
				<div class="card-header flex-wrap border-0" id="default-tab">
					<h4 class="card-title">{{$cardTitle??"Transaksi Produk"}}</h4>
				</div>
				@if($transactions->count() === 0)
					<x-admin.empty-data></x-admin.empty-data>
				@else
					<div class="card-body pt-0">
						<div class="table-responsive">
							<table class="table" width="100%">
								<thead>
								<tr>
									<th>Nomor</th>
									<th>Kode Transaksi</th>
									<th>Order Number</th>
									<th>Quantity</th>
									<th>Product Name</th>
									<th>Product Wight (grams)</th>
									<th>Transaction Type</th>
									<th>Transaction Date</th>
								</tr>
								</thead>
								<tbody>
								@foreach($transactions as $key => $transaction)
									<tr>
										<td>{{$transactions->firstItem()+$key}}</td>
										<td>{{$transaction->code??"-"}}</td>
										<td>{{$transaction->order->order_number??"-"}}</td>
										<td>{{$transaction->quantity . " pcs"}}</td>
										<td>{{$transaction->product->name??"-"}}</td>
										<td>{{($transaction->product?->weight??"-")}}</td>
										<td>
											@if($transaction->type === "in")
												<span class="badge bg-success">Masuk</span>
											@elseif($transaction->type === "out")
												<span class="badge bg-danger">Keluar</span>
											@else
												<span class="badge bg-warning">Transaksi Dibatalkan</span>
											@endif
										</td>
										<td>{{$transaction->created_at??"-"}}</td>
									</tr>
								@endforeach
								</tbody>
							</table>
							{{$transactions->withQueryString()->links()}}
						</div>
					</div>
				@endif
			</div>
		</div>
	</div>

</x-admin.layout>


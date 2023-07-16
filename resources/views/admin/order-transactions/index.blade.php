@extends('layouts.admin.master')
@push('title')
	Admin Abon Alfitri | Beranda
@endpush

@push('breadcrumb')
	ORDER
@endpush

@section('content')
	<div class="row">
		<!-- Column  -->
		<div class="col-lg-12">
			<div class="card dz-card">
				<div class="card-header flex-wrap border-0" id="default-tab">
					<h4 class="card-title">Order</h4>
				</div>
				<div class="tab-content" id="myTabContent">
					<div class="default-tab">
						<div class="tab-content" id="myTabContent">
							<div class="tab-pane fade show active" id="Preview" role="tabpanel"
							     aria-labelledby="home-tab">
								<div class="card-body pt-0">
									<div class="table-responsive">
										<table id="example4" class="table" width="100%">
											<thead>
											<tr>
												<th>Nomor</th>
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
													<td>{{$transaction->order->order_number??"-"}}</td>
													<td>{{$transaction->quantity . " pcs"}}</td>
													<td>{{$transaction->product->name??"-"}}</td>
													<td>{{($transaction->product?->weight??"-")}}</td>
													<td>
														@if($transaction->type === 1)
															<span class="badge bg-danger">Keluar</span>
														@else
															<span class="badge bg-success">Masuk</span>
														@endif
													</td>
													<td>{{$transaction->created_at??"-"}}</td>
												</tr>
											@endforeach
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection

@push('js')

@endpush

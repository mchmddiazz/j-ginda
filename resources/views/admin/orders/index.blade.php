@php use App\Enums\PaymentStatusEnum; @endphp
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
											<td>
												@if($order->status === PaymentStatusEnum::PENDING())
													<span class="badge bg-warning">Tertunda</span>
												@elseif($order->status === PaymentStatusEnum::DECLINE())
													<span class="badge bg-danger">Ditolak</span>
												@elseif($order->status === PaymentStatusEnum::PROCESSING())
													<span class="badge bg-primary">Diproses</span>
												@elseif($order->status === PaymentStatusEnum::COMPLETED())
													<span class="badge bg-success">Selesai</span>
												@endif
											<td>{{$order->created_at}}</td>
											<td>
												<div class="d-grid gap-2 d-md-block">
													<a href="{{route('admin.orders.show', $order->id)}}"
													   class="btn btn-primary btn-sm" type="button">Detail</a>
													<button class="btn btn-primary" type="button">Button</button>
													<button class="btn btn-primary" type="button">Button</button>
												</div>
											</td>
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
	</div>

</x-admin.layout>
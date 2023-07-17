<x-admin.layout>
	<div class="row">
		<!-- Column  -->
		<div class="col-lg-12">
			<div class="card dz-card">
				<div class="card-header flex-wrap border-0" id="default-tab">
					<h4 class="card-title">{{$cardTitle ?? "Produk"}}</h4>
				</div>
				<div class="card-body pt-0">
					<div class="pt-4">
						<div class="table-responsive">
							<form action="{{route('admin.request.production.store')}}" method="POST">
								@csrf
								<table class="table">
									<thead>
									<tr>
										<th scope="col">No</th>
										<th scope="col">Nama Produk</th>
										<th scope="col">Kuantitas Gudang</th>
										<th scope="col">Ambang Batas Kuantitas</th>
										<th scope="col">Kondisi Stok</th>
										<th scope="col">Berat (gram)</th>
									</tr>
									</thead>
									<tbody>
									@foreach($requestProductions as $key => $requestProduction)
										<tr>
											<td scope="col">No</td>
											<td scope="col">Nama Produk</td>
											<td scope="col">Kuantitas Gudang</td>
											<td scope="col">Ambang Batas Kuantitas</td>
											<td scope="col">Kondisi Stok</td>
											<td scope="col">Berat (gram)</td>
										</tr>
									@endforeach
									</tbody>
								</table>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
</x-admin.layout>

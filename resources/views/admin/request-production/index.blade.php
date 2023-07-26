<x-admin.layout>
	<div class="row">
		<!-- Column  -->
		<div class="col-lg-12">
			<div class="card dz-card">
				<div class="card-header flex-wrap border-0" id="default-tab">
					<h4 class="card-title">{{$cardTitle ?? "Produk"}}</h4>
				</div>
				<div class="card-body pt-0">
					<ul class="nav nav-tabs mb-4">
						<li class="nav-item">
							<a class="nav-link {{ request()->fullUrl() === route('admin.request.production.index', ['status' => 'waiting']) || request()->fullUrl() === route('admin.request.production.index') ? 'active' : '' }}" aria-current="page" href="{{route('admin.request.production.index', ['status' => 'waiting'])}}">Menunggu Produksi</a>
						</li>
						<li class="nav-item">
							<a class="nav-link {{ request()->fullUrl() === route('admin.request.production.index', ['status' => 'done']) ? 'active' : '' }}" href="{{route('admin.request.production.index', ['status' => 'done'])}}">Sudah Diproduksi</a>
						</li>
						<li class="nav-item">
							<a class="nav-link {{  request()->fullUrl() === route('admin.request.production.index', ['status' => 'cancel']) ? 'active' : '' }}" href="{{route('admin.request.production.index', ['status' => 'cancel'])}}">Batal Produksi</a>
						</li>
					</ul>
					@if($requestProductions->count() === 0)
						<x-admin.empty-data></x-admin.empty-data>
					@else
						<div class="pt-4">
							<div class="table-responsive">
								<form action="{{route('admin.request.production.update')}}" method="POST">
									@csrf
									@method('PATCH')
									@if(request()->query("status", "waiting") === "waiting" || request()->query("status") === "")
										<div class="d-grid gap-2 d-md-block">
											<button class="btn btn-info" type="reset">Reset</button>
											<button class="btn btn-primary" name="type" value="save"  type="submit">Simpan</button>
											<button class="btn btn-danger" name="type" value="cancel" type="submit">Batalkan</button>
										</div>
									@endif
									<table class="table">
										<thead>
										<tr>
											@if(request()->query("status") === "waiting")
												<th scope="col">Aksi</th>
											@endif
											<th scope="col">Nama Produk</th>
											<th scope="col">Kuantitas Gudang</th>
											<th scope="col">Ambang Batas Kuantitas</th>
											<th scope="col">Permintaan Produksi</th>
											<th scope="col">Produksi Terpenuhi</th>
											<th scope="col">Berat (gram)</th>
											<th scope="col">Status</th>
											<th scope="col">Tanggal Permintaan</th>
										</tr>
										</thead>
										<tbody>
										@foreach($requestProductions as $key => $requestProduction)
											<tr>
												@if(request()->query("status") === "waiting")
													<td>
														<div class="d-grid gap-2 d-md-block">
															<input class="form-check-input request-production-id"
															       type="checkbox" name="request_production_ids[]"
															       value="{{$requestProduction->id}}">
															<input type="number"
															       class="form-control-sm d-none request-production-quantity"
															       name="actual_quantities[]" disabled>
														</div>
													</td>
												@endif
												<td>{{$requestProduction->product?->name??"-"}}</td>
												<td>{{($requestProduction->product?->quantity??0) . " pcs"}}</td>
												<td>{{($requestProduction->product?->quantity_threshold??0) . " pcs"}}</td>
												<td><span class="badge bg-warning">{{ ($requestProduction->request_quantity) . " pcs"}}</span></td>
												<td><span class="badge bg-success">{{ ($requestProduction->actual_quantity) . " pcs"}}</span></td>
												<td>{{ ($requestProduction->product?->weight??0) . " grams"}}</td>
												<td>
													@if($requestProduction->status === "waiting")
														<span class="badge bg-warning">Menunggu</span>
													@elseif($requestProduction->status === "done")
														<span class="badge bg-success">Selesai</span>
													@else
														<span class="badge bg-danger">Batal</span>
													@endif
												</td>
												<td>{{$requestProduction->created_at}}</td>
											</tr>
										@endforeach
										</tbody>
									</table>
									{{$requestProductions->withQueryString()->links()}}
								</form>
							</div>
						</div>
					@endif

				</div>
			</div>
		</div>
	</div>


	@push("js")
		<script>
            $(".request-production-id").on("click", function () {
                const quantity = $(this).siblings();
                const isChecked = $(this).is(":checked");

                if (isChecked) {
                    quantity.removeClass("d-none")
                    quantity.removeAttr("disabled")
                } else {
                    quantity.addClass("d-none")
                    quantity.prop("disabled", true)
                }
            });
		</script>
	@endpush
</x-admin.layout>

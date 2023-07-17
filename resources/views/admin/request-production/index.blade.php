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
							<form action="{{route('admin.request.production.update')}}" method="POST">
								@csrf
								@method('PATCH')
								<div class="d-grid gap-2 d-md-block">
									<button class="btn btn-info" type="reset">Reset</button>
									<button class="btn btn-primary" type="submit">Simpan</button>
								</div>
								<table class="table">
									<thead>
									<tr>
										<th scope="col">No</th>
										<th scope="col">Nama Produk</th>
										<th scope="col">Kuantitas Gudang</th>
										<th scope="col">Ambang Batas Kuantitas</th>
										<th scope="col">Permintaan Produksi</th>
										<th scope="col">Berat (gram)</th>
									</tr>
									</thead>
									<tbody>
									@foreach($requestProductions as $key => $requestProduction)
										<tr>
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
											<td>{{$requestProduction->product?->name??"-"}}</td>
											<td>{{($requestProduction->product?->quantity??0) . " pcs"}}</td>
											<td>{{($requestProduction->product?->quantity_threshold??0) . " pcs"}}</td>
											<td>{{ ($requestProduction->request_quantity) . " pcs"}}</td>
											<td>{{ ($requestProduction->product?->weight??0) . " grams"}}</td>
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


	@push("js")
		<script>
            $(".request-production-id").on("click", function () {
                const quantity = $(this).siblings();
                const isChecked = $(this).is(":checked");

                if(isChecked){
                    quantity.removeClass("d-none")
                    quantity.removeAttr("disabled")
                }else{
                    quantity.addClass("d-none")
                    quantity.prop("disabled", true)
                }
            });
		</script>
	@endpush
</x-admin.layout>

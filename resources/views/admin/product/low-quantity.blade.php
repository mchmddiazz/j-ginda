@php use App\Enums\PermissionEnum; @endphp
<x-admin.layout>
	<div class="row">
		<!-- Column  -->
		<div class="col-lg-12">
			<div class="card dz-card">
				<div class="card-header flex-wrap border-0" id="default-tab">
					<h4 class="card-title">{{$cardTitle ?? "Produk"}}</h4>
				</div>
				<div class="tab-content" id="myTabContent">
					<div class="tab-pane fade show active" id="DefaultTab" role="tabpanel" aria-labelledby="home-tab">
						<div class="card-body pt-0">
							<div class="pt-4">
								<div class="table-responsive">
									<form action="{{route('admin.request.production.store')}}" method="POST">
										@csrf
										@can(PermissionEnum::ADMIN_REQUEST_PRODUCTION_STORE())
											<div class="d-grid gap-2 d-md-block">
												<button class="btn btn-info" type="reset">Reset</button>
												<button class="btn btn-primary" type="submit">Simpan</button>
											</div>
										@endcan
										<table class="table">
											<thead>
											<tr>
												@can(PermissionEnum::ADMIN_REQUEST_PRODUCTION_STORE())
													<th scope="col">Request Produksi</th>
												@endcan
												<th scope="col">Nama Produk</th>
												<th scope="col">Kuantitas Gudang</th>
												<th scope="col">Ambang Batas Kuantitas</th>
												<th scope="col">Kondisi Stok</th>
												<th scope="col">Berat (gram)</th>
											</tr>
											</thead>
											<tbody>
											@foreach($products as $key => $product)
												<tr>
													@can(PermissionEnum::ADMIN_REQUEST_PRODUCTION_STORE())
														<td>
															<div class="d-grid gap-2 d-md-block">
																<input class="form-check-input request-production-id"
																       type="checkbox" name="product_ids[]"
																       value="{{$product->id}}">
																<input type="number"
																       class="form-control-sm d-none request-production-quantity"
																       name="quantities[]" disabled>
															</div>
														</td>
													@endcan
													<td>{{$product->name}}</td>
													<td>{{$product->quantity . " pcs"}}</td>
													<td>{{$product->quantity_threshold . " pcs"}}</td>
													<td>
														@if($product->quantity > $product->quantity_threshold)
															<span class="badge rounded-pill bg-success">Stok Terpenuhi</span>
														@elseif($product->quantity === 0)
															<span class="badge rounded-pill bg-danger">Stok Habis</span>
														@else
															<span class="badge rounded-pill bg-warning">Stok Menipis</span>
														@endif
													</td>
													<td>{{$product->weight. " grams"}}</td>
												</tr>
											@endforeach
											</tbody>
										</table>
									</form>
									{{$products->withQueryString()->links()}}
								</div>
							</div>
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

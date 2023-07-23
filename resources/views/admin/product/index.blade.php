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
							<!-- Nav tabs -->
							<div class="default-tab">
								<ul class="nav nav-tabs" role="tablist">
									<li class="nav-item">
										<a class="nav-link active" data-bs-toggle="tab" href="#product"><i
													class="la la-table me-2"></i> List Produk</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-bs-toggle="tab" href="#add-product"><i
													class="la la-plus me-2"></i> Tambah Produk</a>
									</li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane fade show active" id="product" role="tabpanel">
										@if($products->count()===0)
											<x-admin.empty-data></x-admin.empty-data>
										@else
											<div class="pt-4">
												<div class="table-responsive">
													<table class="table">
														<thead>
														<tr>
															<th scope="col">No</th>
															<th scope="col">Nama Produk</th>
															<th scope="col">Kuantitas Gudang</th>
															<th scope="col">Ambang Batas Kuantitas</th>
															<th scope="col">Kondisi Stok</th>
															<th scope="col">Berat (gram)</th>
															<th scope="col">Gambar</th>
															<th scope="col">Aksi</th>
														</tr>
														</thead>
														<tbody>
														@foreach($products as $key => $product)
															<tr>
																<td>{{$products->firstItem() + $key}}</td>
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
																<td>
																	@if($product->image && $product->image!== '')
																		<img height="100px"
																		     src="{{asset('storage/products/'.$product->image)}}">
																	@else
																		<img src="https://via.placeholder.com/150" height="100px">
																	@endif
																</td>
																<td>
																	<div class="d-grid gap-2 d-md-block">
																		<a href="{{route('admin.products.edit', $product->id)}}"
																		   class="btn btn-success btn-sm" type="button">Sunting</a>
																		<button type="button"
																		        class="btn btn-danger btn-sm btn-delete"
																		        data-id="{{ $product->id }}">Hapus
																		</button>
																	</div>
																</td>
															</tr>
														@endforeach
														</tbody>
													</table>
													{{$products->withQueryString()->links()}}
												</div>
											</div>
										@endif
									</div>
									<div class="tab-pane fade" id="add-product">
										<div class="pt-4">
											<div class="basic-form">
												<form class="form-valide-with-icon needs-validation"
												      enctype="multipart/form-data" novalidate id="data-master"
												      method="POST" action="{{route('admin.products.store')}}">
													@csrf
													<div class="mb-3">
														<label class="text-label form-label"
														       for="validationCustomUsername">Nama Produk</label>
														<div class="input-group">
                                                        <span class="input-group-text"> <i class="fa fa-list-alt"></i>
                                                        </span>
															<input type="text" name="name" class="form-control"
															       id="validationCustomUsername"
															       placeholder="Enter a name product.." required>
															<div class="invalid-feedback">
																Please Enter a Product Name.
															</div>
														</div>
													</div>
													<div class="mb-3">
														<label class="text-label form-label" for="price">Harga
															*</label>
														<div class="input-group transparent-append">
                                                        <span class="input-group-text"> Rp.
                                                        </span>
															<input type="number" name="price"
															       onkeypress="return hanyaAngka(event)"
															       oninput="setCustomValidity('')"
															       class="form-control uang"
															       id="price" placeholder="Enter a price product.."
															       required>
															<div class="invalid-feedback">
																Please Enter a Price Product.
															</div>
														</div>
													</div>

													<div class="mb-3">
														<label class="text-label form-label" for="price">Harga Diskon
															*</label>
														<div class="input-group transparent-append">
                                                        <span class="input-group-text"> Rp.
                                                        </span>
															<input type="number" name="priceDisc"
															       onkeypress="return hanyaAngka(event)"
															       oninput="setCustomValidity('')"
															       class="form-control uang"
															       id="priceDisc" placeholder="Enter a price product.."
															       required>
															<div class="invalid-feedback">
																Please Enter a Price Product.
															</div>
														</div>
													</div>
													<div class="mb-3">
														<label class="text-label form-label" for="price">Jumlah
															*</label>
														<div class="input-group transparent-append">
                                                        <span class="input-group-text"> Qty.
                                                        </span>
															<input type="number" name="quantity"
															       onkeypress="return hanyaAngka(event)"
															       oninput="setCustomValidity('')"
															       class="form-control uang"
															       id="quantity"
															       placeholder="Enter a quantity product.."
															       required>
															<div class="invalid-feedback">
																Please Enter a Quantity Product.
															</div>
														</div>
													</div>
													<div class="mb-3">
														<label class="text-label form-label" for="price">Ambang Batas
															Kuantitas
															*</label>
														<div class="input-group transparent-append">
                                                        <span class="input-group-text"> Qty.
                                                        </span>
															<input type="number" name="quantity_threshold"
															       onkeypress="return hanyaAngka(event)"
															       oninput="setCustomValidity('')"
															       class="form-control uang"
															       id="quantity"
															       placeholder="Enter a quantity product.."
															       required>
															<div class="invalid-feedback">
																Please Enter a Quantity Product.
															</div>
														</div>
													</div>
													<div class="mb-3">
														<label class="text-label form-label" for="price">Berat ( GRAM )
															*</label>
														<div class="input-group transparent-append">
                                                        <span class="input-group-text"> Gr.
                                                        </span>
															<input type="number" name="weight"
															       onkeypress="return hanyaAngka(event)"
															       oninput="setCustomValidity('')" class="form-control"
															       id="weight" placeholder="Enter a weight Product.."
															       required>
															<div class="invalid-feedback">
																Please Enter a Weight Product.
															</div>
														</div>
													</div>
													<div class="mb-3">
														<label class="form-label">Banner (select one):</label>
														<select class="default-select  form-control wide"
														        name="slideActive">
															<option value="0">Tidak</option>
															<option value="1">Ya</option>
														</select>
													</div>
													<div class="mb-3">
														<label class="text-label form-label" for="dz-password">Photo
															*</label>
														<div class="input-group transparent-append">
															<input id="image" type="file" name="image" accept="image/*"
															       onchange="readURL(this);">
															<input type="hidden" name="hidden_image" id="hidden_image">
															<div class="invalid-feedback">
																Please Enter a Image.
															</div>
														</div>

													</div>
													<div class="mb-3">
														<img id="modal-preview" src="https://via.placeholder.com/150"
														     alt="Preview" class="form-group hidden" width="100"
														     height="100">
													</div>
													<button type="submit" class="btn me-2 btn-primary"
													        id="simpan-data">Tambah
													</button>
												</form>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<form id="form-delete" action="{{route('admin.products.destroy', ':id') }}" class="d-none" method="POST">
		@csrf
		@method("DELETE")
	</form>

	@push("js")
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
		<script>
            function changeFormUrlWithId(id, defaultUrl, formSelector) {
                const newUrl = defaultUrl.replace(":id", id);
                $(formSelector).attr("action", newUrl);
            }

            function alertConfirm(successCallback, newConfig) {
                let config = {
                    title: 'Apakah anda yakin ?',
                    text: "Ketika dihapus anda tidak dapat membatalkannya !",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus !',
                    cancelButtonText: 'Batalkan !'
                };

                if (newConfig != undefined) {
                    config = {...config, ...newConfig}
                }

                Swal.fire(config).then((result) => {
                    if (result.isConfirmed && typeof successCallback == "function") {
                        successCallback();
                    }
                })
            }

            let defaultDeleteUrl = $("#form-delete").attr("action");

            $(".btn-delete").on("click", function () {
                changeFormUrlWithId($(this).data("id"), defaultDeleteUrl, "#form-delete");

                alertConfirm(() => {
                    $("#form-delete").trigger("submit");
                })
            });
		</script>

	@endpush
</x-admin.layout>

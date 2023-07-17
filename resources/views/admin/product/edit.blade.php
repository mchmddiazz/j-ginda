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
							<div class="pt-4">
								<div class="basic-form">
									<form class="form-valide-with-icon needs-validation"
									      enctype="multipart/form-data" novalidate id="data-master" method="POST"
									      action="{{route('admin.products.update', $product->id)}}">
										@csrf
										@method('PATCH')
										<div class="mb-3">
											<label class="text-label form-label"
											       for="validationCustomUsername">Nama Produk</label>
											<div class="input-group">
                                                        <span class="input-group-text"> <i class="fa fa-list-alt"></i>
                                                        </span>
												<input type="text" name="name" class="form-control"
												       id="validationCustomUsername"
												       placeholder="Enter a name product.." required value="{{$product->name}}">
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
												       oninput="setCustomValidity('')" class="form-control uang"
												       id="price" placeholder="Enter a price product.." required value="{{$product->price}}">
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
												       oninput="setCustomValidity('')" class="form-control uang"
												       id="priceDisc" placeholder="Enter a price product.."
												       required value="{{$product->priceDisc}}">
												<div class="invalid-feedback">
													Please Enter a Price Product.
												</div>
											</div>
										</div>
										<div class="mb-3">
											<label class="text-label form-label" for="price">Ambang Batas Kuantitas
												*</label>
											<div class="input-group transparent-append">
                                                        <span class="input-group-text"> Qty.
                                                        </span>
												<input type="number" name="quantity_threshold"
												       onkeypress="return hanyaAngka(event)"
												       oninput="setCustomValidity('')" class="form-control uang"
												       id="quantity" placeholder="Enter a quantity product.."
												       required value="{{$product->quantity_threshold}}">
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
												       required value="{{$product->weight}}">
												<div class="invalid-feedback">
													Please Enter a Weight Product.
												</div>
											</div>
										</div>
										<div class="mb-3">
											<label class="text-label form-label" for="dz-password">Deskripsi
												*</label>
											<textarea class="form-control" id="ckeditor" name="description"
											          required>{{$product->description}}</textarea>
											<div class="invalid-feedback">
												Please Enter a Description.
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
										<input type="hidden" name="product_id" id="product_id">
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

	<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Modal title</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal">
					</button>
				</div>

				<form class="form-valide-with-icon needs-validation" enctype="multipart/form-data" novalidate
				      id="data-master-edit">
					@csrf
					<div class="modal-body">
						<div class="mb-3">
							<label class="text-label form-label" for="validationCustomUsername">Nama Produk</label>
							<div class="input-group">
                            <span class="input-group-text"> <i class="fa fa-list-alt"></i>
                            </span>
								<input type="text" name="name" class="form-control" id="nameEdit"
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
								<input type="number" name="price" onkeypress="return hanyaAngka(event)"
								       oninput="setCustomValidity('')" class="form-control uang" id="priceEdit"
								       placeholder="Enter a price product.." required>
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
								<input type="number" name="priceDisc" onkeypress="return hanyaAngka(event)"
								       oninput="setCustomValidity('')" class="form-control uang" id="priceDiscEdit"
								       placeholder="Enter a price product.." required>
								<div class="invalid-feedback">
									Please Enter a Price Product.
								</div>
							</div>
						</div>
						<div class="mb-3">
							<label class="text-label form-label" for="price">Jumlah Ambang Batas
								*</label>
							<div class="input-group transparent-append">
                            <span class="input-group-text"> Qty.
                            </span>
								<input type="number" name="quantity_threshold" onkeypress="return hanyaAngka(event)"
								       oninput="setCustomValidity('')" class="form-control uang" id="quantityEdit"
								       placeholder="Enter a quantity product.." required>
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
								       id="weightEdit" placeholder="Enter a weight Product.."
								       required>
								<div class="invalid-feedback">
									Please Enter a Weight Product.
								</div>
							</div>
						</div>
						<div class="mb-3">
							<label class="text-label form-label" for="dz-password">Deskripsi
								*</label>
							<textarea class="form-control" id="ckeditorEdit" name="description" required></textarea>
							<div class="invalid-feedback">
								Please Enter a Description.
							</div>
						</div>
						<div class="mb-3">
							<label class="form-label">Banner (select one):</label>
							<select class="default-select form-control wide" name="slideActive" id="slideActiveEdit">
								<option value="0">Tidak</option>
								<option value="1">Ya</option>
							</select>
						</div>
						<div class="mb-3">
							<label class="text-label form-label" for="dz-password">Photo
								*</label>
							<div class="input-group transparent-append">
								<input id="imageEdit" type="file" name="image" accept="image/*"
								       onchange="readURLEdit(this);">
								<input type="hidden" name="hidden_image" id="hidden_imageEdit">
								<div class="invalid-feedback">
									Please Enter a Image.
								</div>
							</div>

						</div>
						<input type="hidden" name="product_id" id="product_idEdit">
						<div class="mb-3">
							<img id="modal-previewEdit" src="https://via.placeholder.com/150" alt="Preview"
							     class="form-group hidden" width="100" height="100">
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary" id="simpan-data-edit">Update</button>
					</div>

				</form>
			</div>
		</div>
	</div>
</x-admin.layout>

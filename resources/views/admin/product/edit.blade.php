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
											<label class="text-label form-label"
												   for="description">Deskripsi</label>
											<div class="input-group">
                                                        <span class="input-group-text"> <i class="fa fa-list-alt"></i>
                                                        </span>
												<input type="text" name="description" class="form-control"
													   id="description"
													   placeholder="Enter a name product.." value="{{$product->description}}">
												<div class="invalid-feedback">
													Please Enter a Product Description.
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
										<a href="{{route('admin.products.index')}}" class="btn me-2 btn-secondary"
										        id="simpan-data">Kembali
										</a>
										<button type="submit" class="btn me-2 btn-primary"
										        id="simpan-data">Update
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

</x-admin.layout>

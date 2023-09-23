<x-landing.layout>
	<div class="axil-single-product-area bg-color-white">
		<div class="single-product-thumb axil-section-gap pb--20 pb_sm--0">
			<div class="container">
				<div class="row row--25">
					<div class="col-lg-6 mb--40">
						<div class="h-100">
							<div class="position-sticky sticky-top">
								<div class="row">
									<!-- End .col -->
									<div class="col-12 mb--20">
										<div class="single-product-thumbnail axil-product thumbnail-grid">
											<div class="thumbnail">
												@if($product->image && $product->image !== "")
													@if($product->image2 && $product->image2 !== "")
													<div class="slider-product owl-carousel owl-theme">
													@endif
													<img class="img-fluid product-image"
													     src="{{ asset('/storage/products/'. $product->image)}}"
													     alt="Product Images">
													@if($product->image2 && $product->image2 !== "")
													<img class="img-fluid product-image"
													     src="{{ asset('/storage/products/'. $product->image2)}}"
													     alt="Product Images">
													@endif
													@if($product->image2 && $product->image2 !== "")
													</div>
													@endif
												@else
													<img src="https://via.placeholder.com/150">
												@endif
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-6 mb--40">
						<div class="h-100">

							<form id="data-cart-add" enctype="multipart/form-data">
								@csrf
								<div class="position-sticky sticky-top">
									<div class="single-product-content">
										<div class="inner">
											<h2 class="product-title">{{ $product->name }}</h2>
											@if ($product->priceDisc && ($product->price > $product->priceDisc))
											<strike>{{ formatToRupiah($product->price)  }}</strike>
											<span class="price-amount">{{  formatToRupiah($product->priceDisc)  }}</span>
											@else
											<span class="price-amount">{{ formatToRupiah($product->price)  }}</span>
											@endif

											<p>{{$product->description ?? "-"}}</p>

											<ul class="product-meta">
												@if ($product->quantity > 0)
													<li>
														<i class="fal fa-check"></i>Stock
														Tersisa {{ $product->quantity }}</li>
												@else
													<li><i class="fal fa-window-close"></i>Sold Out</li>
												@endif
											</ul>

											<!-- Start Product Action Wrapper  -->
											<div class="product-action-wrapper d-flex-center">
												<!-- Start Quentity Action  -->
												<div class="pro-qty mr--20"><input type="number" value="1" min="1"
												                                   name="quantity"></div>
												<!-- End Quentity Action  -->

												<input type="hidden" value="{{ $product->id }}" name="id">
												<input type="hidden" value="{{ $product->name }}" name="name">
												@if ($product->price > 0 && ($product->priceDisc == 0))
												<input type="hidden" value="{{ $product->price }}"name="priceDisc">
												@elseif ($product->priceDisc > 0 && $product->price > 0)
												<input type="hidden" value="{{ $product->priceDisc }}"name="priceDisc">
												@endif
												<input type="hidden" value="{{ $product->image }}" name="image">
												<input type="hidden" value="{{ $product->weight }}" name="weight">
												<!-- Start Product Action  -->
												<ul class="product-action d-flex-center mb--0">
													<li class="add-to-cart"><input type="submit"
													                               id="button_create_troli"
													                               class="axil-btn btn-bg-primary"
													                               value="Tambahkan Keranjang">
													</li>
												</ul>
												<!-- End Product Action  -->

											</div>
											<!-- End Product Action Wrapper  -->
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>

				<div class="axil-product-area bg-color-white axil-section-gap pb--50 pb_sm--30">
					<div class="container">
						<div class="section-title-wrapper">
                        <span class="title-highlighter highlighter-primary"><i class="far fa-shopping-basket"></i> Your
                            Recently</span>
							<h2 class="title">RELATED PRODUCTS</h2>
						</div>
						<div class="recent-product-activation slick-layout-wrapper--15 axil-slick-arrow arrow-top-slide">
							@foreach ($productList as $item)
								@if ($product->id !== $item->id)
									<form id="data-cart-add-detail" enctype="multipart/form-data">
										@csrf
										<div class="slick-single-layout">
											<div class="axil-product">
												<div class="thumbnail">
													<a href="{{ route('products.show', $item->id) }}">
														@if($item->image && $item->image !== "")
															<img class="img-fluid product-image"
															     src="{{ asset('/storage/products/'. $item->image)}}"
															     alt="Product Images">
														@else
															<img src="https://via.placeholder.com/150">
														@endif
													</a>
												</div>
												<div class="product-content">
													<div class="inner">
														<h5 class="title">
															<a href="{{ route('products.show', $product->id) }}">{{ $item->name }}</a>
														</h5>
														<div class="product-price-variant">
															@if ($item->price > 0 && ($item->priceDisc == 0))
															<span class="price current-price">{{  formatToRupiah($item->price) }}</span>
															@elseif ($item->price > 0 && ($item->priceDisc > 0))
															<span class="price current-price">{{formatToRupiah($item->priceDisc) }}</span>
															<span class="price old-price">{{  formatToRupiah($item->price) }}</span>
															@endif
														</div>
													</div>
												</div>
											</div>
										</div>

									</form>
								@endif
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</x-landing.layout>


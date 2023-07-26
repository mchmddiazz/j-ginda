<x-landing.layout>
	<div class="axil-main-slider-area main-slider-style-1">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-lg-5 col-sm-6">
					<div class="main-slider-content">
						<div class="slider-content-activation-one">
							@foreach ($slide as $slider)
								<div class="single-slide slick-slide" data-sal="slide-up" data-sal-delay="400"
								     data-sal-duration="800">
									<span class="subtitle"><i
												class="fas fa-fire"></i> Promo Terbaik Di Minggu Ini</span>
									<h3 class="title">{{ $slider->name }}</h3>
								</div>
							@endforeach
						</div>
					</div>
				</div>

				<div class="col-lg-7 col-sm-6">
					<div class="main-slider-large-thumb">
						<div class="slider-thumb-activation-one axil-slick-dots">

							@foreach ($slide as $sliders)
								<div class="single-slide slick-slide" data-sal="slide-up" data-sal-delay="600"
								     data-sal-duration="1500">
									<img src="{{URL::to('product')}}/{{$sliders->image}}">
								</div>
							@endforeach
						</div>
					</div>
				</div>

			</div>
		</div>


		<ul class="shape-group">

		</ul>
	</div>
	<!-- Start Expolre Product Area  -->
	<div class="axil-product-area bg-color-white axil-section-gap">
		<div class="container">
			<div class="section-title-wrapper">
				<span class="title-highlighter highlighter-primary"> <i
							class="far fa-shopping-basket"></i> Produk</span>
				<h2 class="title">Produk</h2>
			</div>

			{{-- PRODUCT LIST--}}
			<div class="explore-product-activation slick-layout-wrapper slick-layout-wrapper--15 axil-slick-arrow arrow-top-slide">
				<!-- End .slick-single-layout -->
				<div class="slick-single-layout">
					<div class="row row--15">
						@foreach ($products as $key=> $product)
							<div class="col-xl-3 col-lg-4 col-sm-6 col-6 mb--30">
								<div class="axil-product product-style-one">
									<div class="thumbnail">
										<a href="{{ route('products.show', $product->id) }}">
											@if($product->image && $product->image!== '')
												<img height="50px" src="{{asset('storage/products/'.$product->image)}}"
												     alt="Product Images">
											@else
												<img src="https://via.placeholder.com/150" height="100px"
												     alt="Product Images">
											@endif
										</a>
										<div class="product-hover-action">
											<ul class="cart-action">
												<li class="select-option">
													<a href="#" data-id="{{ base64_encode($product->id) }}"
													   id="button_create_troli_detail">
														Add To Cart
													</a>
												</li>
												<li class="quickview">
													<a href="#" data-bs-toggle="modal"
													   data-bs-target="#quick-view-modal"
													   data-id="{{ base64_encode($product->id) }}"
													   id="button_add">
														<i class="far fa-eye"></i>
													</a>
												</li>
											</ul>
										</div>
									</div>
									<div class="product-content">
										<div class="inner">
											<h5 class="title">
												<a href="{{ route('products.show', $product->id) }}">{{ $product->name }}</a>
											</h5>
											<div class="product-price-variant">
												<span class="price current-price">{{ "Rp " . number_format($product->priceDisc, 0, ",", ".") }}</span>
												<span class="price old-price">{{ "Rp" . number_format($product->price, 0, ",", ".") }}</span>
											</div>
										</div>
									</div>
								</div>
							</div>
						@endforeach
					</div>

					{{$products->withQueryString()->links()}}
				</div>
				<!-- End .slick-single-layout -->
			</div>
		</div>
	</div>
	<!-- End Expolre Product Area  -->
</x-landing.layout>



<x-landing.layout>
	<div class="axil-main-slider-area main-banner main-slider-style-1">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-12">
					<img src="{{ asset('assets/images/main-banner.png') }}">
				</div>
			</div>
		</div>


		<ul class="shape-group">

		</ul>
	</div>
	<!-- Start Expolre Product Area  -->
	<div class="axil-product-area product-grid bg-color-white axil-section-gap">
		<div class="container">
			<div class="section-title-wrapper">
				<h2 class="title text-center">Produk terlaris minggu ini</h2>
			</div>

			{{-- PRODUCT LIST--}}
			<div class="explore-product-activation slick-layout-wrapper slick-layout-wrapper--15 axil-slick-arrow arrow-top-slide">
				<!-- End .slick-single-layout -->
				<div class="slick-single-layout">
					<div class="row row--15">
						@foreach ($products->slice(0, 8) as $key=> $product)
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
									</div>
									<div class="product-content">
										<div class="inner">
											<h5 class="title">
												<a href="{{ route('products.show', $product->id) }}">{{ $product->name }}</a>
											</h5>
											<div class="product-price-variant">
												@if ($product->price > 0 && ($product->priceDisc == 0))
												<span class="price current-price">{{ formatToRupiah($product->price) }}</span>
												@elseif ($product->price > 0 && ($product->priceDisc > 0))
												<span class="price current-price">{{ formatToRupiah($product->priceDisc) }}</span>
												<span class="price old-price">{{ formatToRupiah($product->price) }}</span>
												@endif
											</div>
										</div>
									</div>
								</div>
							</div>
						@endforeach
					</div>

					<div class="container">
						<div class="row text-center">
							<div class="col-12">
								<a href="{{ url('/shop') }}" class="axil-btn btn-bg-primary">Lihat semua produk</a>
							</div>
						</div>
					</div>
				</div>
				<!-- End .slick-single-layout -->
			</div>
		</div>
	</div>
	<!-- End Expolre Product Area  -->
</x-landing.layout>



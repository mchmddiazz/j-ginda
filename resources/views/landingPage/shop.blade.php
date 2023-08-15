<x-landing.layout>

	<!-- Start Breadcrumb Area  -->
	<div class="axil-breadcrumb-area">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-lg-6 col-md-8">
					<div class="inner">
						<ul class="axil-breadcrumb">
							<li class="axil-breadcrumb-item"><a href="{{ route('landing.home') }}">Home</a></li>
							<li class="separator"></li>
							<li class="axil-breadcrumb-item active" aria-current="page">Shop</li>
						</ul>
						<h1 class="title">Shop</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Breadcrumb Area  -->
	<!-- Start Shop Area  -->
	<div class="axil-shop-area axil-section-gap bg-color-white">
		<div class="container">
			<form id="data-cart-add" enctype="multipart/form-data">
				@csrf
				<div class="row row--15">
					@foreach ($product as $item)
						<div class="col-xl-3 col-lg-4 col-sm-6">
							<div class="axil-product product-style-one has-color-pick mt--40">
								<div class="thumbnail">
									<a href="{{ route('products.show', $item->id) }}">
										@if($item->image && $item->image!== '')
											<img height="100px"
											     src="{{asset('storage/products/'.$item->image)}}">
										@else
											<img src="https://via.placeholder.com/150"
											     height="100px">
										@endif
									</a>
								</div>
								<div class="product-content">
									<div class="inner">
										<h5 class="title">
											<a href="{{ route('products.show', $item->id) }}">{{ $item->name }}</a>
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
					@endforeach

				</div>
			</form>
		</div>
		<!-- End .container -->
	</div>
	<!-- End Shop Area  -->

</x-landing.layout>


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
									<div class="product-hover-action">
										<ul class="cart-action">
											<li class="select-option">
												<a href="#" data-id="{{ base64_encode($item->id) }}"
												   id="button_create_troli_detail">Add To Cart
												</a>
											</li>
											<li class="quickview">
												<a href="{{ route('products.show', $item->id) }}"
												   data-bs-toggle="modal"
												   data-bs-target="#quick-view-modal"
												   data-id="{{ $item->id }}"
												   id="button_add">
													<i class="far fa-eye"></i>
												</a>
											</li>
										</ul>
										<input type="hidden" value="{{ $item->id }}" name="id">
										<input type="hidden" value="{{ $item->name }}" name="name">
										<input type="hidden" value="{{ $item->priceDisc }}" name="priceDisc">
										<input type="hidden" value="{{ $item->image }}" name="image">
										<input type="hidden" value="1" name="quantity">
									</div>
								</div>
								<div class="product-content">
									<div class="inner">
										<h5 class="title">
											<a href="{{ route('products.show', $item->id) }}">{{ $item->name }}</a>
										</h5>
										<div class="product-price-variant">
											<span class="price current-price">{{formatToRupiah($item->priceDisc) }}</span>
											<span class="price old-price">{{  formatToRupiah($item->price) }}</span>
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


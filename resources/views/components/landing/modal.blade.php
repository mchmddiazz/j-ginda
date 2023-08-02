<div class="modal fade quick-view-product" id="quick-view-modal" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
							class="far fa-times"></i></button>
			</div>
			<div class="modal-body">
				<form id="data-modal" enctype="multipart/form-data">
					@csrf
					<div class="single-product-thumb" id="modalProductBody">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- Header Search Modal End -->
<div class="header-search-modal" id="header-search-modal">
	<button class="card-close sidebar-close"><i class="fas fa-times"></i></button>
	<div class="header-search-wrap">
		<div class="card-header">
			<div class="input-group">
				<input type="search" class="form-control" name="prod-search" id="prod-search"
				       placeholder="Menulis sesuatu....">
				<button type="submit" class="axil-btn btn-bg-primary"><i class="far fa-search"></i></button>
			</div>
		</div>

		<div class="card-body">
			<form id="dataTroliBuy" enctype="multipart/form-data">
				@csrf
				<div class="" id="bodySearch"></div>
			</form>
		</div>
	</div>
</div>
<!-- Header Search Modal End -->
<div class="cart-dropdown" id="cart-dropdown">
	<div class="cart-content-wrap">
		<div class="cart-header">
			<h2 class="header-title">Keranjang</h2>
			<button class="cart-close sidebar-close"><i class="fas fa-times"></i></button>
		</div>
		<div class="cartBody">
		</div>

		<div class="cartBodyOriginal">
			@if (!empty($cart))
				<div class="cart-body">
					<ul class="cart-item-list">
						@foreach($cart as $item)
							<li class="cart-item">
								<div class="item-img">
									<a href="#">
										@if($item->attributes->image !== null && $item->attributes->image !== '')
											<img src="{{ asset('storage/products/'. $item->attributes->image) }}"
											     alt="Commodo Blown Lamp x4">
										@else
											<img alt="placeholder" src="https://via.placeholder.com/150" height="100px">
										@endif
									</a>

									<button class="close-btn"><a href="#" data-id="{{ base64_encode($item->id) }}"
									                             id="buton_delete_troli"><i
													class="fal fa-times"></i></a></button>
								</div>
								<div class="item-content">
									<div class="product-rating">
										{{-- <span class="icon">
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
									</span>
									<span class="rating-number">(64)</span> --}}
									</div>
									<h3 class="item-title"><a href="#">{{$item->name}}</a></h3>
									<div class="item-price">
										{{ "Rp " . number_format($item->price, 0, ",", ".") }}
									</div>
									<div class="pro-qty item-quantity">
										<input type="number" class="quantity-input" value="{{$item->quantity}}"
										       name="quantity" min="1">
									</div>
								</div>
							</li>
						@endforeach
					</ul>
				</div>
				<div class="cart-footer">
					<h3 class="cart-subtotal">
						<span class="subtotal-title">Subtotal:</span>
						<span class="subtotal-amount">{{ "Rp. " . number_format(Cart::getTotal(), 0, ",", ".") }}</span>
					</h3>
					<div class="group-btn">
						<a href="{{ url('cart') }}" class="axil-btn btn-bg-primary viewcart-btn">Lihat Keranjang</a>
						<a href="{{ url('checkout') }}" class="axil-btn btn-bg-secondary checkout-btn">Checkout</a>
					</div>
				</div>
			@endif
		</div>
	</div>
</div>

<!-- Offer Modal Start -->
<div class="offer-popup-modal" id="offer-popup-modal">
	<div class="offer-popup-wrap">
		<div class="card-body">
			<button class="popup-close"><i class="fas fa-times"></i></button>
			<div class="content">
				<div class="section-title-wrapper">
                    <span class="title-highlighter highlighter-primary"> <i class="far fa-shopping-basket"></i> Don’t
                        Miss!!</span>
					<h3 class="title">Best Sales Offer<br> Grab Yours</h3>
				</div>
				<div class="poster-countdown countdown"></div>
				<a href="shop.html" class="axil-btn btn-bg-primary">Shop Now <i class="fal fa-long-arrow-right"></i></a>
			</div>
		</div>
	</div>
</div>
<div class="closeMask"></div>

@extends('layouts.landingPage.master')
@push('title')
Abon Alfitri | Beranda
@endpush

@push('customcss')

@endpush


@section('content-main')
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
                                            <img class="img-fluid product-image" src="{{ asset('storage/products/'. $productDetail->image)}}"
                                                alt="Product Images">
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
                                        <h2 class="product-title">{{ $productDetail->name }}</h2>
                                        @if ($productDetail->price > $productDetail->priceDisc)
                                        <strike>{{ formatToRupiah($product->price)  }}</strike>
                                        <span class="price-amount">{{  formatToRupiah($product->priceDisc)  }}</span>
                                        @else if ($productDetail->pricedisc >= 0 && $productDetail->price > 0)
                                        <span class="price-amount">{{ "Rp " . number_format($productDetail->price, 0, ",", ".")  }}</span>
                                        @endif

                                        <ul class="product-meta">
                                            @if ($productDetail->quantity > 0)
                                            <li><i class="fal fa-check"></i>Stock tersisa {{ $productDetail->quantity }}</li>
                                            @else
                                            <li><i class="fal fa-window-close"></i>Sold Out</li>
                                            @endif
                                        </ul>
                                        <p class="description">{!! html_entity_decode($productDetail->description) !!}
                                        </p>

                                        <!-- Start Product Action Wrapper  -->
                                        <div class="product-action-wrapper d-flex-center">
                                            <!-- Start Quentity Action  -->
                                            <div class="pro-qty mr--20"><input type="number" value="1" min="1"
                                                    name="quantity"></div>
                                            <!-- End Quentity Action  -->

                                            <input type="hidden" value="{{ $productDetail->id }}" name="id">
                                            <input type="hidden" value="{{ $productDetail->name }}" name="name">
                                            @if ($productDetail->price > 0 && ($productDetail->priceDisc == 0))
                                            <input type="hidden" value="{{ $productDetail->price }}"name="priceDisc">
                                            @else if ($productDetail->priceDisc > 0 && $productDetail->price > 0)
                                            <input type="hidden" value="{{ $productDetail->priceDisc }}"name="priceDisc">
                                            @endif
                                            <input type="hidden" value="{{ $productDetail->image }}" name="image">
                                            <input type="hidden" value="{{ $productDetail->weight }}" name="weight">
                                            <!-- Start Product Action  -->
                                            <ul class="product-action d-flex-center mb--0">
                                                <li class="add-to-cart"><input type="submit" id="button_create_troli"
                                                        class="axil-btn btn-bg-primary" value="Tambahkan Keranjang">
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
                        @foreach ($product as $item)
                        @if ($productDetail->id != $item->id)
                        <form id="data-cart-add-detail" enctype="multipart/form-data">
                            @csrf
                            <div class="slick-single-layout">
                                <div class="axil-product">
                                    <div class="thumbnail">
                                        <a href="{{ route('products.show', $item->id) }}">
                                            <img src="{{ asset('storage/products/'. $item->image)}}" alt="Product Images" style="width:255px; height:339px;">
                                            
                                        </a>
                                    </div>
                                    <div class="product-content">
                                        <div class="inner">
                                            <h5 class="title"><a
                                                    href="{{ route('products.show',$item->id) }}">{{ $item->name }}</a>
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


<!-- End .slick-single-layout -->

@endsection

@push('customjs')

@endpush

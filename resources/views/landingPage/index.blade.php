@extends('layouts.landingPage.master')
@push('title')
Abon Alfitri | Home
@endpush

@push('customcss')
@endpush

@section('content-main')
<div class="axil-main-slider-area main-slider-style-1">
    <div class="container">
        <div class="row align-items-center">

            <div class="col-lg-5 col-sm-6">
                <div class="main-slider-content">
                    <div class="slider-content-activation-one">
                        @foreach ($slide as $slider)
                        <div class="single-slide slick-slide" data-sal="slide-up" data-sal-delay="400"
                            data-sal-duration="800">
                            <span class="subtitle"><i class="fas fa-fire"></i> Promo Terbaik Di Minggu Ini</span>
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
                            {{-- <div class="product-price">
                                            <span class="text">From</span>
                                            <span class="price-amount">Rp. 50.000</span>
                                        </div> --}}
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
            <span class="title-highlighter highlighter-primary"> <i class="far fa-shopping-basket"></i> Produk</span>
            <h2 class="title">Produk</h2>
        </div>
        <div
            class="explore-product-activation slick-layout-wrapper slick-layout-wrapper--15 axil-slick-arrow arrow-top-slide">
            <!-- End .slick-single-layout -->
            <div class="slick-single-layout">
                <div class="row row--15">
                    @foreach ($product as $item)
                    <div class="col-xl-3 col-lg-4 col-sm-6 col-6 mb--30">
                        <div class="axil-product product-style-one">
                            <div class="thumbnail">
                                <a href="{{ url('product/getProduct/details', base64_encode($item->id)) }}">
                                    <img src="{{ asset('product/'. $item->image)}}" alt="Product Images" style="width:255px; height:339px;">
                                </a>
                                <div class="product-hover-action">
                                    <ul class="cart-action">
                                        <li class="select-option"><a href="#" data-id="{{ base64_encode($item->id) }}" id="button_create_troli_detail">Add To Cart</a></li>
                                        <li class="quickview"><a href="#" data-bs-toggle="modal"
                                                data-bs-target="#quick-view-modal"
                                                data-id="{{ base64_encode($item->id) }}" id="button_add"><i
                                                    class="far fa-eye"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product-content">
                                <div class="inner">
                                    <h5 class="title"><a href="{{ url('product/getProduct/details', base64_encode($item->id)) }}">{{ $item->name }}</a></h5>
                                    <div class="product-price-variant">
                                        <span
                                            class="price current-price">{{ "Rp " . number_format($item->priceDisc, 0, ",", ".") }}</span>
                                        <span
                                            class="price old-price">{{ "Rp" . number_format($item->price, 0, ",", ".") }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <!-- End .slick-single-layout -->
        </div>
        <div class="row">
            <div class="col-lg-12 text-center mt--20 mt_sm--0">
                <a href="{{ url('/shop') }}" class="axil-btn btn-bg-lighter btn-load-more">View All Products</a>
            </div>
        </div>

    </div>
</div>
<!-- End Expolre Product Area  -->
@endsection

@push('customjs')
@endpush

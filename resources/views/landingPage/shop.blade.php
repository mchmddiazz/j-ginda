@extends('layouts.landingPage.master')
@push('title')
Abon Alfitri | Beranda
@endpush

@push('customcss')

@endpush

@section('content-main')
<!-- Start Breadcrumb Area  -->
<div class="axil-breadcrumb-area">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-8">
                <div class="inner">
                    <ul class="axil-breadcrumb">
                        <li class="axil-breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
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
            {{-- <div class="row"
                <div class="col-lg-12">
                    <div class="axil-shop-top">
                        <div class="row">
                            <div class="col-lg-9">

                            </div>
                            <div class="col-lg-3">
                                <div class="category-select mt_md--10 mt_sm--10 justify-content-lg-end">
                                    <!-- Start Single Select  -->
                                    <select class="single-select">
                                        <option>Sort by Latest</option>
                                        <option>Sort by Name</option>
                                        <option>Sort by Price</option>
                                        <option>Sort by Viewed</option>
                                    </select>
                                    <!-- End Single Select  -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="row row--15">
                @foreach ($product as $item)
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="axil-product product-style-one has-color-pick mt--40">
                        <div class="thumbnail">
                            <a href="{{ url('product/getProduct/details', base64_encode($item->id)) }}">
                                <img src="{{ asset('product/'. $item->image)}}" alt="Product Images" style="width:255px; height:339px;">
                            </a>
                            <div class="product-hover-action">
                                <ul class="cart-action">
                                    <li class="select-option"><a href="#" data-id="{{ base64_encode($item->id) }}" id="button_create_troli_detail">Add To Cart</a></li>
                                    <li class="quickview"><a href="{{ url('product/getProduct/details', base64_encode($item->id)) }}" data-bs-toggle="modal"
                                            data-bs-target="#quick-view-modal" data-id="{{ base64_encode($item->id) }}"
                                            id="button_add"><i class="far fa-eye"></i></a></li>
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
        </form>
        {{-- <div class="text-center pt--30">
                <a href="#" class="axil-btn btn-bg-lighter btn-load-more">Load more</a>
            </div> --}}
    </div>
    <!-- End .container -->
</div>
<!-- End Shop Area  -->


@endsection

@push('customjs')
@endpush

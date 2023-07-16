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
                        <li class="axil-breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="separator"></li>
                        <li class="axil-breadcrumb-item active" aria-current="page">About Us</li>
                    </ul>
                    <h1 class="title">About Our Store</h1>
                </div>
            </div>
            <div class="col-lg-6 col-md-4">
                <div class="inner">
                    <div class="bradcrumb-thumb">
                       <img src="{{ asset('logo/logoAlfitri.png') }}" alt="Image" style="height:100px;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Breadcrumb Area  -->

<!-- Start About Area  -->
<div class="axil-about-area about-style-1 axil-section-gap ">
    <div class="container">
        <div class="row align-items-center">
        @foreach ($about_us as $item)
            <div class="col-xl-4 col-lg-6">
                <div class="about-thumbnail">
                    <div class="thumbnail">
                        <img src="{{ asset('about/'. $item->image)}}" alt="About Us">
                    </div>
                </div>
            </div>
            <div class="col-xl-8 col-lg-6">
                <div class="about-content content-right">
                    <span class="title-highlighter highlighter-primary2"> <i class="far fa-shopping-basket"></i>About Store</span>
                    <h3 class="title">{{ $item->name }}</h3>
                    <div class="row">
                        <div class="col-xl-12">
                            <p>{!! html_entity_decode( $item->description) !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<!-- End About Area  -->

<br>
<br>
<br>
@endsection

@push('customjs')

@endpush

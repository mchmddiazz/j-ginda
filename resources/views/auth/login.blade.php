<x-landing.layout>
@push('css')
<style>
    body {
        overflow-y: auto;
        overflow-x: hidden;
        -webkit-overflow-scrolling: touch;
    }
</style>
@endpush

<div class="axil-breadcrumb-area">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-8">
                <div class="inner">
                    <ul class="axil-breadcrumb">
                        <li class="axil-breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="separator"></li>
                        <li class="axil-breadcrumb-item active" aria-current="page">Sign In</li>
                    </ul>
                    <h1 class="title">Sign In</h1>
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
<div class="service-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="mt-4">
                    <x-admin.alert></x-admin.alert>
                </div>

                <div class="axil-signin-form" style="padding: 30px 0;">
                    <h3 class="title">Masuk ke Abon Alfitri.</h3>
                    <p class="b2 mb--55">Masukkan detail Anda di bawah ini</p>
                    <form class="singin-form" id="formLogin" method="POST" action="{{route('authenticate')}}">
                        @csrf
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" placeholder="annie@example.com">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password" placeholder="">
                        </div>
                        <div class="form-group d-flex align-items-center justify-content-between">
                            <button type="submit" class="axil-btn btn-bg-primary submit-btn"
                                id="button_login">Masuk</button>
                            <a href="{{ route('show.registration') }}" class="forgot-btn">Belum punya akun ?</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</x-landing.layout>

  <header class="header axil-header header-style-5">
    <div class="axil-header-top">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-sm-6 col-12">
                    <div class="header-top-dropdown">
                       
                    </div>
                </div>
                <div class="col-lg-6 col-sm-6 col-12">
                    <div class="header-top-link">
                        <ul class="quick-link">
                            @if(Illuminate\Support\Facades\Auth::check())
                                <li><a href="{{ url('logout') }}">Logout</a></li>
                            @else
                                <li><a href="{{ url('login') }}">Login</a></li>
                                <li><a href="{{ url('register') }}">Register</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <!-- Start Mainmenu Area  -->
        <div id="axil-sticky-placeholder"></div>
        <div class="axil-mainmenu">
            <div class="container">
                <div class="header-navbar">
                    <div class="header-brand">
                        <a href="{{ url('/') }}" class="logo logo-dark">
                            <img src="{{ asset('logo/logoAlfitri.png')}}" alt="Site Logo" style="height: 95px; filter: contrast(1)">
                        </a>
                        <a href="{{ url('/') }}" class="logo logo-light">
                            <img src="{{ asset('logo/logoAlfitri.png')}}" alt="Site Logo" style="height: 95px; filter: contrast(1)">
                        </a>
                    </div>
                    <div class="header-main-nav">
                        <!-- Start Mainmanu Nav -->
                        <nav class="mainmenu-nav">
                            <button class="mobile-close-btn mobile-nav-toggler"><i class="fas fa-times"></i></button>
                            <div class="mobile-nav-brand">
                                <a href="{{ url('/') }}" class="logo">
                                    <img src="{{ asset('logo/logoAlfitri.png')}}" alt="Site Logo" style="height: 70px;">
                                </a>
                            </div>
                            <ul class="mainmenu">
                                <li><a class="{{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">HOME</a></li>
                                <li><a class="{{ request()->is('shop') ? 'active' : '' }}" href="{{ url('/shop') }}">SHOP</a></li>
                                <li><a class="{{ request()->is('story') ? 'active' : '' }}" href="{{ url('/story') }}">STORY</a></li>
                            </ul>
                        </nav>
                        <!-- End Mainmanu Nav -->
                    </div>
                    <div class="header-action">
                        <ul class="action-list">
                            <li class="axil-search">
                                <a href="javascript:void(0)" class="header-search-icon" title="Search">
                                    <i class="flaticon-magnifying-glass"></i>
                                </a>
                            </li>
                            {{-- <li class="wishlist">
                                <a class="{{ request()->is('/wishlist') ? 'active' : '' }}" href="{{ url('/wishlist') }}">
                                    <i class="flaticon-heart"></i>
                                </a>
                            </li> --}}
                            
                            @if(Illuminate\Support\Facades\Auth::check())
                            <li class="shopping-cart">
                                <a href="#" class="cart-dropdown-btn">
                                    <span class="cart-count">{{ Cart::getTotalQuantity()}}</span>
                                    <i class="flaticon-shopping-cart"></i>
                                </a>
                            </li>
                            @else

                            <li class="shopping-cart">
                                <a href="#" class="cart-dropdown-btn0">
                                    <span class="cart-count"></span>
                                    <i class="flaticon-shopping-cart"></i>
                                </a>
                            </li>
                            @endif
                            <li class="my-account">
                                <a href="javascript:void(0)">
                                    <i class="flaticon-person"></i>
                                </a>
                                <div class="my-account-dropdown">
                                    <span class="title">Hey, Sahabat Alfitri</span>
                                    @if(Illuminate\Support\Facades\Auth::check())
                                    <ul>
                                        <li>
                                            <a href="{{ url('account') }}"><span>My Account</span></a>
                                        </li>
                                        <li>                                        
                                            <a href="{{ url('logout') }}" class="axil-btn btn-bg-primary">Logout</a>
                                        </li>
                                    </ul>
                                    @else
                                    <div class="login-btn">
                                        <a href="{{ route('login') }}" class="axil-btn btn-bg-primary">Login</a>
                                    </div>
                                    <div class="reg-footer text-center">No account yet? <a href="{{ route('register') }}" class="btn-link">REGISTER HERE.</a></div>

                                    @endif
                                </div>
                            </li>
                            <li class="axil-mobile-toggle">
                                <button class="menu-btn mobile-nav-toggler">
                                    <i class="flaticon-menu-2"></i>
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Mainmenu Area -->
    </header>

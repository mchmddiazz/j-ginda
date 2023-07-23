<?php

namespace App\Http\Controllers\LandingPage;

use App\Http\Controllers\Controller;
use App\Services\HomeService;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\AboutUs;
use App\Models\Visitor;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
use App\Repositories\Product\ProductRepository;

class HomeController extends Controller
{
    public function index(HomeService $service):Response
    {
        $response = $service->getIndexData();
        viewShare($response);
        return response()->view('landingPage/index');
    }


    public function shop(Request $request)
    {
        if (Auth::check()) {
            $data = $this->cartProductGlobal();
        } else {
            $data = $this->cartProductGlobalNonUSer();
        }
        $data['about_us'] = AboutUs::limit(1)->orderBy('created_at', 'DESC')
            ->get();
        return view('landingPage.shop', $data);
    }

    function wishlist(Request $request)
    {
        if (Auth::check()) {
            $data = $this->cartProductGlobal();
        } else {
            $data = $this->cartProductGlobalNonUSer();
        }
        $data['about_us'] = AboutUs::limit(1)->orderBy('created_at', 'DESC')
            ->get();
        return view('landingPage.wishlist', $data);
    }

    function about(Request $request)
    {
        if (Auth::check()) {
            $data = $this->cartProductGlobal();
        } else {
            $data = $this->cartProductGlobalNonUSer();
        }
        $data['about_us'] = AboutUs::limit(1)->orderBy('created_at', 'DESC')
            ->get();
        return view('landingPage.about', $data);
    }

    function virtualOutlet(Request $request)
    {
        if (Auth::check()) {
            $data = $this->cartProductGlobal();
        } else {
            $data = $this->cartProductGlobalNonUSer();
        }

        return view('landingPage.404', $data);
    }
}

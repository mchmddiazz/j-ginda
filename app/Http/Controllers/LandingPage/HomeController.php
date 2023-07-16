<?php

namespace App\Http\Controllers\LandingPage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
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
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    function index(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d');
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $browser = 'Unknown';
        $operation_system = 'Unknown';

        if (preg_match('/linux/i', $user_agent)) {

            if (preg_match('/android/i', $user_agent)) {
                $operation_system = 'Android';
            } else {
                $operation_system = 'Linux';
            }
        } elseif (preg_match('/macintosh|mac os x/i', $user_agent)) {
            $operation_system = 'Mac';
        } elseif (preg_match('/windows|win32/i', $user_agent)) {
            $operation_system = 'Windows';
        } elseif (preg_match('/windows|win64/i', $user_agent)) {
            $operation_system = 'Windows';
        }

        if (preg_match('/MSIE/i', $user_agent) && !preg_match('/Opera/i', $user_agent)) {
            $browser = 'Internet Explorer';
        } elseif (preg_match('/Firefox/i', $user_agent)) {
            $browser = 'Mozilla Firefox';
        } elseif (preg_match('/Chrome/i', $user_agent)) {
            $browser = 'Google Chrome';
        } elseif (preg_match('/Safari/i', $user_agent)) {
            $browser = 'Apple Safari';
        } elseif (preg_match('/Opera/i', $user_agent)) {
            $browser = 'Opera';
        } elseif (preg_match('/Netscape/i', $user_agent)) {
            $browser = 'Netscape';
        }

        $cek  = Visitor::where('date', $date)
            ->whereAddressIp($_SERVER['REMOTE_ADDR'])
            ->count();

        if ($cek == 0) {
            $tambah_visitor                     = new Visitor;
            $tambah_visitor->address_ip         = $_SERVER['REMOTE_ADDR'];
            $tambah_visitor->browser            = $browser;
            $tambah_visitor->operation_system   = $operation_system;
            $tambah_visitor->date               = $date;
            $tambah_visitor->save();

        }

        if(Auth::check())
        { 
            $data = [
                'cart' => \Cart::session(Auth::user()->id)->getContent(),
                'product' => Product::where('slideActive', 0)        
                ->where('status', 1)
                ->limit(8)->get(),
                'slide' => Product::where('slideActive', 1)        
                ->where('status', 1)
                ->limit(3)->get()
            ];
        } else {
            
            $data = [
                'cart' => null,
                'product' => Product::where('slideActive', 0)        
                ->where('status', 1)
                ->limit(8)->get(),
                'slide' => Product::where('slideActive', 1)        
                    ->where('status', 1)
                    ->limit(3)->get(),
            ];
        }
        $data['about_us'] = AboutUs::limit(1)->orderBy('created_at', 'DESC')
        ->where('status', 1)->get();
        return view('landingPage/index')->with($data);
    }

    function shop(Request $request)
    {
        if(Auth::check())
        {
            $data = $this->cartProductGlobal();
        } else {
            $data = $this->cartProductGlobalNonUSer();
        }
        $data['about_us'] = AboutUs::limit(1)->orderBy('created_at', 'DESC')
        ->where('status', 1)->get();
        return view('landingPage.shop', $data);
    }

    function wishlist(Request $request)
    {
        if(Auth::check())
        {
            $data = $this->cartProductGlobal();
        } else {
            $data = $this->cartProductGlobalNonUSer();
        }
        $data['about_us'] = AboutUs::limit(1)->orderBy('created_at', 'DESC')
        ->where('status', 1)->get();
        return view('landingPage.wishlist', $data);
    }

    function about(Request $request)
    {
        if(Auth::check())
        {
            $data = $this->cartProductGlobal();
        } else {
            $data = $this->cartProductGlobalNonUSer();
        }
        $data['about_us'] = AboutUs::limit(1)->orderBy('created_at', 'DESC')
        ->where('status', 1)->get();
        return view('landingPage.about', $data);
    }

    function virtualOutlet(Request $request)
    {
        if(Auth::check())
        {
            $data = $this->cartProductGlobal();
        } else {
            $data = $this->cartProductGlobalNonUSer();
        }
        
        return view('landingPage.404', $data);
    }
}

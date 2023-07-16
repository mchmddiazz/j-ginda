<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\AboutUs;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
use App\Repositories\Product\ProductRepository;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }
    
    function cartProductGlobal()
    {
        $data = [
            'cart' => \Cart::session(Auth::user()->id)->getContent(),
            'product' => $this->productRepository->findAll()
        ];

        return $data;
    }

    function cartProductGlobalNonUSer()
    {
        $data = [
            'cart' => null,
            'product' => $this->productRepository->findAll()
        ];

        return $data;
    }

    private function sensor( $data = '' )
    {
        if ($data == '') {
            return "-";
        } else {
            $sensor = substr($data,0,3);
            $censored = 'X';
            for ($i=0; $i < strlen($data)-4; $i++) {
                $censored .= "X";
            }
            return $sensor.$censored;
        }
    }

    function aboutUsGlobal()
    {
        $data = [
            'cart' => AboutUs::limit(1)->where('status', 1)->orderBy('id', 'DESC')->get(),
        ];

        return $data;
    }
}

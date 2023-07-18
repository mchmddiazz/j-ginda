<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\RedirectResponse;
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

    protected RedirectResponse $response;

    /**
     * Use to check is response from service error or not
     *
     * @return bool
     */
    protected function isError(array $response, string $redirectRoute = null, array $params = []): bool
    {
        if (!$response["success"]) {
            if ($redirectRoute) {
                $this->setErrorResponse(
                    redirect()->route($redirectRoute, $params)->withErrors(["errors" => $response["message"]])->withInput()
                );
            } else {
                $this->setErrorResponse(
                    redirect()->back()->withErrors(["errors" => $response["message"]])->withInput()
                );
            }
            return true;
        }

        return false;
    }

    /**
     * Use to set data response when response error
     * @param RedirectResponse $response
     * @return void
     */
    protected function setErrorResponse(RedirectResponse $response): void
    {
        $this->response = $response;
    }

    /**
     * Use to redirect when error
     * @return RedirectResponse
     */
    protected function getErrorResponse(): RedirectResponse
    {
        return $this->response;
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
            'cart' => AboutUs::limit(1)->orderBy('id', 'DESC')->get(),
        ];

        return $data;
    }
}

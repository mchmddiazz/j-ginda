<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthenticateRequest;
use App\Http\Requests\Auth\RegistrationRequest;
use App\Services\AuthService;
use App\Services\RegistrationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Order;
use App\Rules\MatchOldPassword;
use App\Models\AboutUs;

class AuthController extends Controller
{

    /**
     * @return Response
     */
    public function showRegistration():Response
    {
        return response()->view('auth.register');
    }

    /**
     * @param RegistrationService $service
     * @param RegistrationRequest $request
     * @return RedirectResponse
     */
    public function registration(RegistrationService $service, RegistrationRequest $request):RedirectResponse
    {
        $response = $service->registration($request->validated());
        if ($this->isError($response)) return $this->getErrorResponse();

        return redirect()->route("login")->with("success", ucfirst("Pendaftaran berhasil silahkan login !"));
    }

    /**
     * @return Response
     */
    public function login():Response
    {
        return response()->view('auth.login');
    }


    /**
     * @param AuthService $service
     * @param AuthenticateRequest $request
     * @return RedirectResponse
     * @throws \Illuminate\Auth\AuthenticationException
     */
    public function authenticate(AuthService $service, AuthenticateRequest $request):RedirectResponse
    {
        $response = $service->authenticate($request->validated());
        if ($this->isError($response)) return $this->getErrorResponse();

        $redirect = Auth::user()->hasRole("user") ? redirect()->route("landing.home") : redirect()->route("admin.dashboard");
        return $redirect->with("success", ucfirst("Login berhasil !"));

    }


    /**
     * @param Request $request
     * @return RedirectResponse
     */
    function logout(Request $request):RedirectResponse
    {
        $redirect = Auth::user()->hasRole("user") ? redirect()->route("login") : redirect()->route("admin.login");

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return $redirect;
    }


    function changePassword(Request $request)
    {
        $request->validate([
            'password' => ['required', new MatchOldPassword],
            'newPassword' => ['required'],
            'confirmNewPassword' => ['same:newPassword'],
        ]);
        $name = $request->first_name . ' ' . $request->last_name;
        User::find(auth()->user()->id)->update(['name' => $name, 'password' => Hash::make($request->newPassword)]);

        return redirect()->back();
    }

    function account()
    {
        $data['orders'] = Order::where('user_id', Auth::user()->id)->get();

        $data['about_us'] = AboutUs::limit(1)->orderBy('created_at', 'DESC')
            ->get();
        return view('landingPage.account.index', $data);
    }
}

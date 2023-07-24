<?php

namespace App\Http\Controllers;

use App\Http\Requests\Account\UpdateAccountRequest;
use App\Models\AboutUs;
use App\Models\Order;
use App\Services\AccountService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{


    /**
     * @param AccountService $service
     * @return Response
     */
    public function edit(AccountService $service): Response
    {
        $response = $service->getEditData();
        viewShare($response);
        return response()->view('landing.account.edit');
    }

    /**
     * @param AccountService $service
     * @param UpdateAccountRequest $request
     * @return RedirectResponse
     */
    public function update(AccountService $service, UpdateAccountRequest $request): RedirectResponse
    {
        $response = $service->updateData($request->validated());
        if ($this->isError($response)) return $this->getErrorResponse();


        return redirect()->route("account.edit")->with("success", ucfirst("Update account berhasil !"));
    }
}

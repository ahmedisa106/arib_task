<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Traits\HelperTrait;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class AuthController extends Controller
{
    use HelperTrait;

    /**
     * @param AuthRequest $request
     * @return RedirectResponse
     */
    public function login(AuthRequest $request): RedirectResponse
    {
        $credentials = $this->getAuthenticationCredentials($request);
        if (auth('admin')->attempt($credentials)) {
            return redirect()->intended();
        }
        return redirect()->back()->withInput()->with('error', 'Invalid Data');

    }// end of login function


    /**
     * @return Application|\Illuminate\Foundation\Application|RedirectResponse|Redirector
     */
    public function logout(): \Illuminate\Foundation\Application|Redirector|RedirectResponse|Application
    {
        auth('admin')->logout();
        return redirect('/admin');
    }// end of logout function
}

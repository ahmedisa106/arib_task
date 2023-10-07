<?php

namespace App\Http\Controllers\Employee\Auth;

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
     * @return Application|\Illuminate\Foundation\Application|RedirectResponse|Redirector
     */
    public function login(AuthRequest $request): \Illuminate\Foundation\Application|Redirector|RedirectResponse|Application
    {
        $credentials = $this->getAuthenticationCredentials($request);
        if (auth('employee')->attempt($credentials)) {
            return redirect('/employee');
        }
        return redirect()->back()->withInput()->with('error', 'Invalid Data');

    }// end of login function


    /**
     * @return \Illuminate\Foundation\Application|Redirector|RedirectResponse|Application
     */
    public function logout(): \Illuminate\Foundation\Application|Redirector|RedirectResponse|Application
    {
        auth('employee')->logout();
        return redirect('/employee');
    }// end of logout function
}

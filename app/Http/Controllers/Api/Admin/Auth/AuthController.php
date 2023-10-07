<?php

namespace App\Http\Controllers\Api\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\AdminResource;
use App\Models\Admin;
use App\Traits\HelperTrait;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use HelperTrait;

    public function __construct()
    {
        $this->middleware('auth:admin_api')->except('login');
    }

    public function login(Request $request)
    {
        $credentials = $this->getAuthenticationCredentials($request);
        if (!$token = auth('admin_api')->attempt($credentials)) {
            return $this->final_response(status: 401, message: 'Data is Invalid');
        }

        return $this->respondWithToken($token);
    }// end of login function


    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth('admin_api')->logout();
        return $this->final_response(message: 'Successfully logged out');
    }


    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        $admin = auth('admin_api')->user();
        $admin['access_token'] = $token;
        $admin = AdminResource::make(auth('admin_api')->user());
        return $this->final_response(message: 'you are logged in successfully', data: $admin);
    }
}

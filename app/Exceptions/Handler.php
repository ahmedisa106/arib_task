<?php

namespace App\Exceptions;

use App\Traits\HelperTrait;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Throwable;

class Handler extends ExceptionHandler
{
    use HelperTrait;

    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * @param $request
     * @param AuthenticationException $exception
     * @return Response|JsonResponse|RedirectResponse
     */
    public function unauthenticated($request, AuthenticationException $exception): Response|JsonResponse|RedirectResponse
    {

        $guard = Arr::get($exception->guards(), 0);
        if (!in_array($guard, ['admin_api', 'manager_api', 'employee_api'])) {
            switch ($guard) {
                case "employee":
                    $route = 'employee_login';
                    break;
                case "manager":
                    $route = 'manager_login';
                    break;
                default:
                    $route = 'login';
            }
            return redirect()->guest(route($route));
        }

        return $this->final_response(status: 401, message: "You Are UnAuthorized");


    }// end of unauthenticated function
}

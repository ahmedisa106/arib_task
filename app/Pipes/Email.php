<?php

namespace App\Pipes;


class Email
{
    public function handle($request, \Closure $next)
    {
        if (request('search') != '') {
            return $next($request)->orWhere('email', 'like', '%' . request('search') . '%');
        }

    }// end of handle function
}

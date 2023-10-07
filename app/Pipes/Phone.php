<?php

namespace App\Pipes;


class Phone
{
    public function handle($request, \Closure $next)
    {
        if (request('search') != '') {
            return $next($request)->orWhere('phone', 'like', '%' . request('search') . '%');
        }
    }// end of handle function
}

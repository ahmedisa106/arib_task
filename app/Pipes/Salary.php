<?php

namespace App\Pipes;


class Salary
{
    public function handle($request, \Closure $next)
    {
        if (request('search') != '') {
            return $next($request)->orWhere('salary', 'like', '%' . request('search') . '%');
        }

    }// end of handle function
}

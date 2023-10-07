<?php

namespace App\Pipes;

class Name
{
    public function handle($query, \Closure $next)
    {

        if (request('search') != '') {
            return $next($query)->where('name', 'like', '%' . request('search') . '%');
        }

    }// end of handle function
}

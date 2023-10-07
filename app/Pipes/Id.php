<?php

namespace App\Pipes;


class Id
{
    public function handle($query, \Closure $next)
    {

        if (request('search') != '') {
            return $next($query)->orWhere('id', 'like', '%' . request('search') . '%');
        }


    }// end of handle function
}

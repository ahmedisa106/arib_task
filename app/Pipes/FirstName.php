<?php

namespace App\Pipes;

class FirstName
{
    public function handle($query, \Closure $next)
    {
        return $next($query)->orWhere('first_name', 'like', '%' . request('search') . '%');
    }// end of handle function
}

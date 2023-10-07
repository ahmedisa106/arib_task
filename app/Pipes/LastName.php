<?php

namespace App\Pipes;

class LastName
{
    public function handle($query, \Closure $next)
    {
        return $next($query)->orWhere('last_name', 'like', '%' . request('search') . '%');
    }// end of handle function
}

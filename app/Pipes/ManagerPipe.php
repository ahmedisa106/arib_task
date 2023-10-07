<?php

namespace App\Pipes;

class ManagerPipe
{
    public function handle($query, \Closure $next)
    {

        if (request('search') != '') {
            return $next($query)->orWhereHas('manager',function ($q){
                $q->where('name', 'like', '%' . request('search') . '%');
            });
        }

    }// end of handle function
}

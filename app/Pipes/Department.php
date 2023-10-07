<?php

namespace App\Pipes;

class Department
{
    public function handle($query, \Closure $next)
    {
        return $next($query)->orWhereHas('department', function ($q) {
            $q->where('name', 'like', '%' . request('search') . '%')
                ->orWhereHas('manager', function ($q) {
                    $q->where('name', 'like', '%' . request('search') . '%');
                });
        });
    }// end of handle function
}

<?php

namespace App\Pipes;

class MangerTaskName
{
    public function handle($request, \Closure $next)
    {

        if (request('search') != '') {
            return $next($request)->where(function ($q) {
                $q->where('name', 'like', '%' . request('search') . '%')
                    ->where(function ($q) {
                        $q->where('manager_id', auth('manager')->id())
                            ->orWhere('employee_id', auth('employee')->id());
                    });
            });
        }

    }// end of handle function
}

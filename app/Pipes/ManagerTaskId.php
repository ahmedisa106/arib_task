<?php

namespace App\Pipes;


class ManagerTaskId
{
    public function handle($query, \Closure $next)
    {

        if (request('search') != '') {
            return $next($query)->orWhere(function ($q) {
                $q->where('id', 'like', '%' . request('search') . '%')
                    ->where(function ($q) {
                        $q->where('manager_id', auth('manager')->id())
                            ->orWhere('employee_id', auth('employee')->id());
                    });
            });
        }


    }// end of handle function
}

<?php

namespace App\Pipes;

class ManagerTaskStatus
{
    public function handle($query, \Closure $next)
    {
        if (request('search') != '')
            return $next($query)->orWhere(function ($q) {
                $q->where('status', 'like', '%' . request('search') . '%')
                    ->where(function ($q) {
                        $q->where('manager_id', auth('manager')->id())
                            ->orWhere('employee_id', auth('employee')->id());
                    });
            });
    }
}

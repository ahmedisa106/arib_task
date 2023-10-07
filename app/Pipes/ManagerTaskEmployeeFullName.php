<?php

namespace App\Pipes;

use Illuminate\Support\Facades\DB;

class ManagerTaskEmployeeFullName
{

    public function handle($query, \Closure $next)
    {
        return $next($query)->orWhereHas('employee', function ($q) {
            $q->where(DB::raw("concat(first_name,' ',last_name)"), 'like', '%' . request('search') . '%')
                ->where(function ($q) {
                    $q->where('manager_id', auth('manager')->id())
                        ->orWhere('employee_id', auth('employee')->id());
                });
        });
    }
}

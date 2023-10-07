<?php

namespace App\Pipes;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class NumberOfEmployee
{
    public function handle($query, \Closure $next)
    {
        if (request('search') != '')
            return $next($query)->orWhereHas('employees')->withCount('employees')->having('employees_count', request('search'));

    }// end of handle function
}

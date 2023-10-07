<?php

namespace App\Pipes;

use Illuminate\Support\Facades\DB;

class FullName
{
    public function handle($query, \Closure $next)
    {
        return $next($query)->orWhere(DB::raw("concat(first_name,' ',last_name)"), 'like', '%' . request('search') . '%');
    }// end of handle function
}

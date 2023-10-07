<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * @var array
     */
    private array $data = [];

    /**
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function index(): \Illuminate\Foundation\Application|View|Factory|Application
    {
        $data = DB::select("(select (select count(id) from employees) as employees_count,
        (select count(id) from managers) as managers_count,
        (select count(id) from departments) as departments_count)")[0];
        $this->data = collect($data)->toArray();
        return view('partials.admin.index', $this->data);
    }// end of index function
}

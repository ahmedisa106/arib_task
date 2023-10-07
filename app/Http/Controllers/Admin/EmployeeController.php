<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\ParentController;
use App\Http\Requests\EmployeeRequest;
use App\Repositories\DepartmentRepo;
use App\Repositories\EmployeeRepo;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;

class EmployeeController extends ParentController
{
    private DepartmentRepo $departmentRepo;

    /**
     * @param DepartmentRepo $departmentRepo
     * @param EmployeeRepo $repo
     * @param string $path
     * @param array $data
     * @param string $section_title
     */
    public function __construct(DepartmentRepo $departmentRepo, EmployeeRepo $repo, string $path = 'partials.admin.employees', array $data = [], string $section_title = 'Employees')
    {
        $this->departmentRepo = $departmentRepo;
        $requestModel = EmployeeRequest::class;
        parent::__construct($repo, $path, $data, $section_title, $requestModel);
    }// end of __construct function

    /**
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function create(): \Illuminate\Foundation\Application|View|Factory|Application
    {
        $this->data['section_title'] = $this->repo->model->getTable();
        $this->data['section_sub_title'] = "create new  " . Str::singular($this->repo->model->getTable());
        $this->data['departments'] = $this->departmentRepo->getData(request: request(), columns: ['id', 'name'], pagination: false);
        return \view($this->path . '.create', $this->data);
    }// end of create function

    /**
     * @param $model_id
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function edit($model_id): \Illuminate\Foundation\Application|View|Factory|Application
    {
        $model = $this->repo->find($model_id);
        $this->data['model'] = $model;
        $this->data['section_title'] = $this->repo->model->getTable();
        $this->data['section_sub_title'] = "Edit   " . Str::singular($this->repo->model->getTable());
        $this->data['departments'] = $this->departmentRepo->getData(request: request(), columns: ['id', 'name'], pagination: false);
        return \view($this->path . '.edit', $this->data);
    }// end of edit function
}



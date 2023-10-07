<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\ParentController;
use App\Http\Requests\DepartmentRequest;
use App\Repositories\DepartmentRepo;
use App\Repositories\ManagerRepo;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;


class DepartmentController extends ParentController
{
    private ManagerRepo $managerRepo;

    /**
     * @param ManagerRepo $managerRepo
     * @param DepartmentRepo $departmentRepo
     * @param string $path
     * @param array $data
     * @param string $section_title
     */
    public function __construct(ManagerRepo $managerRepo, DepartmentRepo $departmentRepo, string $path = 'partials.admin.departments', array $data = [], string $section_title = 'Departments')
    {
        $requestClass = DepartmentRequest::class;
        $this->managerRepo = $managerRepo;
        parent::__construct($departmentRepo, $path, $data, $section_title, $requestClass);
    }// end of __construct function

    /**
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function create(): \Illuminate\Foundation\Application|View|Factory|Application
    {
        $this->data['section_title'] = $this->repo->model->getTable();
        $this->data['section_sub_title'] = "create new  " . Str::singular($this->repo->model->getTable());
        $this->data['managers'] = $this->managerRepo->getData(request: request(), columns: ['id', 'name'], pagination: false);
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
        $this->data['section_title'] = $this->section_title;
        $this->data['section_sub_title'] = "edit department ($model->id) ";
        $this->data['managers'] = $this->managerRepo->getData(request: request(), columns: ['id', 'name'], pagination: false);
        return \view($this->path . '.edit', $this->data);
    }// end of edit function

    /**
     * @param $model_id
     * @return JsonResponse
     */
    public function destroy($model_id): \Illuminate\Http\JsonResponse
    {
        $model = $this->repo->find($model_id);
        if ($model->employees->count() > 0) {
            return response()->json(['message' => 'Department Can not Be Deleted because it is not empty  '], 400);
        }
        $data = $this->repo->destroyData($model);
        if (is_null($data)) {
            return response()->json('success');
        }
        return response()->json($data, 400);
    }// end of destroy function

}

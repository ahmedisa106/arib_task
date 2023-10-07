<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ParentController;
use App\Http\Requests\TaskRequest;
use App\Repositories\EmployeeRepo;
use App\Repositories\ManagerRepo;
use App\Repositories\TaskRepo;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class TaskController extends ParentController
{


    public function __construct(TaskRepo $repo, string $path = 'partials.manager.tasks', array $data = [], string $section_title = 'Tasks', $requestModel = TaskRequest::class)
    {
        parent::__construct($repo, $path, $data, $section_title, $requestModel);
    }


    /**
     * @return View|\Illuminate\Foundation\Application|Factory|Application
     */
    public function create(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $this->data['section_title'] = $this->repo->model->getTable();
        $this->data['section_sub_title'] = "create new  " . Str::singular($this->repo->model->getTable());
        $this->data['employees'] = auth('manager')->user()->employees()->get(['employees.id', 'employees.first_name', 'employees.last_name']);
        return \view($this->path . '.create', $this->data);
    }

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
        $this->data['employees'] = auth('manager')->user()->employees()->get(['employees.id', 'employees.first_name', 'employees.last_name']);
        return \view($this->path . '.edit', $this->data);
    }// end of edit function
}

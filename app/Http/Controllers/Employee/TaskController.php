<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\ParentController;
use App\Repositories\TaskRepo;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use Illuminate\Support\Str;

class TaskController extends ParentController
{
    public function __construct(TaskRepo $repo, string $path = 'partials.employee.tasks', array $data = [], string $section_title = 'Tasks')
    {
        parent::__construct($repo, $path, $data, $section_title);
    }

    /**
     * @param $model_id
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function show($model_id): \Illuminate\Foundation\Application|View|Factory|Application
    {
        $model = $this->repo->find($model_id);
        $this->data['model'] = $model;
        $this->data['section_title'] = $this->repo->model->getTable();
        $this->data['section_sub_title'] = "Show   " . Str::singular($this->repo->model->getTable());
        return \view($this->path . '.show', $this->data);
    }// end of show function

    /**
     * @param $model_id
     * @param Request $request
     * @return JsonResponse
     */
    public function changeStatus($model_id, Request $request): JsonResponse
    {
        $model = $this->repo->find($model_id);
        try {
            $model->update(['status' => $request->status]);

        } catch (\Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], 400);
        }

        return response()->json(['message' => 'Task Updated Successfully']);

    }// end of changeStatus function


}

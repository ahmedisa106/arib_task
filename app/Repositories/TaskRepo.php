<?php

namespace App\Repositories;

use App\Models\Task;
use App\Pipes\ManagerTaskId;
use App\Pipes\ManagerTaskStatus;
use App\Pipes\ManagerTaskEmployeeFullName;
use App\Pipes\MangerTaskName;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;

class TaskRepo extends BaseRepo
{

    public function __construct(Task $model)
    {
        parent::__construct($model);
    }

    /**
     * @param Request|null $request
     * @param array|string $relations
     * @param string|array $columns
     * @param bool|string $pagination
     * @return Collection|LengthAwarePaginator|array
     */
    public function getData(Request $request = null, array|string $relations = [], string|array $columns = '*', bool|string $pagination = true): Collection|LengthAwarePaginator|array
    {
        $data = $this->model->query()->with($relations)->select($columns)->orderBy('id', 'desc');
        if (auth('manager')->check()) {
            $data = clone $data->where(['manager_id' => auth('manager')->id()]);
        } elseif (auth('employee')->check()) {
            $data = clone $data->where(['employee_id' => auth('employee')->id()]);
        }
        if ($request->search != '') {
            $data = $this->searchColumns($data);
        }
        if ($pagination == "true")
            return clone $data->paginate($request->perPage);
        else
            return clone $data->get();
    }// end of getData function

    /**
     * @param $query
     * @return mixed
     */
    public function searchColumns($query): mixed
    {
        return app(Pipeline::class)->send($query)
            ->through([
                ManagerTaskId::class,
                ManagerTaskEmployeeFullName::class,
                ManagerTaskStatus::class,
                MangerTaskName::class,
            ])->thenReturn();

    }// end of searchColumns function
}

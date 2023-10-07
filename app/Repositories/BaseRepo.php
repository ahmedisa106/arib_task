<?php

namespace App\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class BaseRepo
{

    public $model;

    /**
     * @param  $model
     */
    public function __construct($model)
    {
        $this->model = $model;
    }// end of __construct function


    /**
     * @param $id
     * @return mixed
     */
    public function find($id): mixed
    {
        return $this->model->query()->find($id);
    }// end of find function


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
        if (@$request->search != '') {
            $data = $this->searchColumns($data);
        }
        if ($pagination == "true")
            return clone $data->paginate(@$request->perPage);
        else
            return clone $data->get();
    }// end of getData function

    /**
     * @param array $data
     * @return string|void
     */
    public function storeData(array $data)
    {

        try {
            $this->model->query()->create($data);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }

    }// end of store function


    /**
     * @param array $data
     * @return string|void
     */
    public function updateData(array $data, Model $model)
    {
        try {
            $model->update($data);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }

    }// end of store function


    /**
     * @param Model $model
     * @return string|void
     */
    public function destroyData(Model $model)
    {
        try {
            $model->delete();
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }// end of destroy function


}

<?php

namespace App\Repositories;

use App\Models\Department;
use App\Pipes\Id;
use App\Pipes\ManagerPipe;
use App\Pipes\Name;
use App\Pipes\NumberOfEmployee;
use Illuminate\Pipeline\Pipeline;

class DepartmentRepo extends BaseRepo
{

    public function __construct(Department $model)
    {
        parent::__construct($model);

    }// end of __construct function

    /**
     * @param $query
     * @return mixed
     */
    public function searchColumns($query): mixed
    {
        return app(Pipeline::class)->send($query)
            ->through([
                Id::class,
                ManagerPipe::class,
                //NumberOfEmployee::class,
                Name::class,
            ])->thenReturn();

    }// end of searchColumns function

}

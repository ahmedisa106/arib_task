<?php

namespace App\Repositories;

use App\Models\Employee;
use App\Pipes\Department;
use App\Pipes\FirstName;
use App\Pipes\FullName;
use App\Pipes\Id;
use App\Pipes\LastName;
use App\Pipes\Salary;
use Illuminate\Pipeline\Pipeline;

class EmployeeRepo extends BaseRepo
{

    public function __construct(Employee $model)
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
                FirstName::class,
                LastName::class,
                Department::class,
                Salary::class,
                FullName::class
            ])->thenReturn();

    }// end of searchColumns function

}

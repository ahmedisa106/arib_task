<?php

namespace App\Repositories;

use App\Models\Manager;
use App\Pipes\Email;
use App\Pipes\Id;
use App\Pipes\Name;
use App\Pipes\Phone;
use Illuminate\Pipeline\Pipeline;

class ManagerRepo extends BaseRepo
{
    /**
     * @param Manager $model
     */
    public function __construct(Manager $model)
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
                Email::class,
                Phone::class,
                Name::class,
            ])->thenReturn();

    }// end of searchColumns function
}

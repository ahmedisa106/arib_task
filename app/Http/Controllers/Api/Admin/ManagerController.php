<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\ManagerResurce;
use App\Repositories\ManagerRepo;
use App\Traits\HelperTrait;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    use HelperTrait;

    private $repo;

    public function __construct(ManagerRepo $repo)
    {
        $this->repo = $repo;
    }

    public function getAll(Request $request)
    {
        $data = $this->repo->getData(request: $request, relations: ['departments','employees.tasks'] , pagination: @$request->pagination ?? false);
        $model = ManagerResurce::collection($data);
        $paginate_data = [];

        if ($request->pagination == "true") {

            $paginate_data = pagination_urls($data);
        }


        return $this->final_response(data: $model, pagination_urls: @$paginate_data);
    }// end of getAll function
}

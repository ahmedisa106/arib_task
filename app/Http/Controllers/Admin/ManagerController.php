<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\ParentController;
use App\Http\Requests\ManagerRequest;
use App\Repositories\ManagerRepo;

class ManagerController extends ParentController
{

    /**
     * @param ManagerRepo $managerRepo
     * @param string $path
     * @param array $data
     * @param string $section_title
     */
    public function __construct(ManagerRepo $managerRepo, string $path = 'partials.admin.managers', array $data = [], string $section_title = 'Managers')
    {
        $modalRequest = ManagerRequest::class;
        parent::__construct($managerRepo, $path, $data, $section_title, $modalRequest);
    }// end of __construct function
}

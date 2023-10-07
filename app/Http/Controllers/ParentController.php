<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class ParentController extends Controller
{
    public object $repo;
    public string $path;
    public array $data = [];
    public string $section_title;


    /**
     * @param object $repo
     * @param string $path
     * @param array $data
     * @param string $section_title
     * @param  $requestModel
     */
    public function __construct(object $repo, string $path, array $data, string $section_title, $requestModel = null)
    {

        $this->repo = $repo;
        $this->path = $path;
        $this->data = $data;
        $this->requestModel = $requestModel;
        $this->section_title = $section_title;


    }// end of __construct function

    /**
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function index(): \Illuminate\Foundation\Application|View|Factory|Application
    {
        $this->data['section_title'] = $this->section_title;
        return view($this->path . '.index', $this->data);
    }// end of index function


    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function ajaxData(Request $request): JsonResponse
    {
        $data = $this->repo->getData(request: $request, relations: $request->relations ?? [], columns: $request->columns ?? [], pagination: $request->pagination);
        $view = \Illuminate\Support\Facades\View::make($this->path . '.table', compact('data'))->render();
        $pagination = '';
        if ($request->pagination) {
            $pagination = \Illuminate\Support\Facades\View::make('components.pagination_component', compact('data'))->render();
        }
        return response()->json(['view' => $view, 'pagination' => $pagination]);
    }// end of data function

    /**
     * @return View|\Illuminate\Foundation\Application|Factory|Application
     */
    public function create(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $this->data['section_title'] = $this->repo->model->getTable();
        $this->data['section_sub_title'] = "create new  " . Str::singular($this->repo->model->getTable());
        return \view($this->path . '.create', $this->data);
    }// end of create function


    /**
     * @return JsonResponse
     * @throws BindingResolutionException
     */
    public function store(): \Illuminate\Http\JsonResponse
    {
        $validated_data = app()->make($this->requestModel)->validated();
        $data = $this->repo->storeData($validated_data);
        if (is_null($data)) {
            session()->flash('success', ucfirst(Str::singular($this->repo->model->getTable())) . ' Stored Successfully !');
            return response()->json('success', 200);
        }
        return response()->json($data, 400);
    }// end of store function


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
        return \view($this->path . '.edit', $this->data);
    }// end of edit function


    /**
     * @param $model_id
     * @return JsonResponse
     * @throws BindingResolutionException
     */
    public function update($model_id): JsonResponse
    {
        $validated_data = app()->make($this->requestModel)->validated();

        $model = $this->repo->find($model_id);
        $data = $this->repo->updateData($validated_data, $model);
        if (is_null($data)) {
            session()->flash('success', ucfirst(Str::singular($this->repo->model->getTable())) . ' Updated Successfully !');
            return response()->json('success');
        }
        return response()->json($data, 400);
    }// end of update function


    /**
     * @param $model_id
     * @return JsonResponse
     */
    public function destroy($model_id): \Illuminate\Http\JsonResponse
    {
        $model = $this->repo->find($model_id);
        $data = $this->repo->destroyData($model);
        if (is_null($data)) {
            return response()->json('success');
        }
        return response()->json($data, 400);
    }// end of destroy function
}

<?php

namespace App\Http\Controllers\Api;

use App\Services\BaseService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

abstract class CrudController extends ApiController
{

    /**
     * @var BaseService
     */
    protected BaseService $service;

    /**
     * @var string
     */
    protected $singularModel, $pluralModel, $table;

    /**
     * @var JsonResource
     */
    protected $resource;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $models = $this->service->all();
        return $this->showResult($this->resource::collection($models)->response()->getData(),
            "$this->pluralModel retrieved successfully.");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return JsonResponse
     */
    public function store(): JsonResponse
    {
        $model = $this->service->create($this->storeRequest()->validated());
        return $this->showResult(new $this->resource($model),
            "$this->singularModel created successfully.", 201);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $model = $this->service->getOrFail($id);
        return $this->showResult(new $this->resource($model),
            "$this->singularModel retrieved successfully.");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function update(int $id): JsonResponse
    {
        $model = $this->service->update($id, $this->updateRequest()->validated());
        return $this->showResult(new $this->resource($model),
            "$this->singularModel updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $this->service->deleteOrFail($id);
        return $this->showMessage("$this->singularModel deleted successfully.");
    }

    /**
     * Remove the specified resources from storage.
     *
     * @return JsonResponse
     */
    public function multipleDestroy(): JsonResponse
    {
        $this->service->multipleDelete(validate_ids($this->table));
        return $this->showMessage("$this->pluralModel deleted successfully.");
    }
}

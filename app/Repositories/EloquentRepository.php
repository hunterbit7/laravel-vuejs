<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

abstract class EloquentRepository implements BaseRepository
{
    /**
     * @var Model
     */
    protected $model;

    public function all(): Collection
    {
        return $this->model
            ->filter(request()->all())
            ->sortable(request()->all())
            ->latest()
            ->get();
    }

    public function paginate(): LengthAwarePaginator
    {
        return $this->model
            ->filter(request()->all())
            ->sortable(request()->all())
            ->latest()
            ->paginate(items_per_page());
    }

    public function get(int $id): Model|null
    {
        return $this->model->find($id);
    }

    public function getOrFail(int $id): Model
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    public function save(Model $model, array $attributes): bool
    {
        return $model->update($attributes);
    }

    public function update(int $id, array $attributes): Model
    {
        $model = $this->getOrFail($id);
        $this->save($model, $attributes);
        return $model;
    }

    public function delete(int $id): bool
    {
        $model = $this->get($id);

        if ($model == null)
            return false;

        return $model->delete();
    }

    public function deleteOrFail(int $id): bool
    {
        $model = $this->getOrFail($id);
        return $model->delete();
    }

    public function multipleDelete(array $ids): bool
    {
        return $this->model->destroy($ids);
    }
}

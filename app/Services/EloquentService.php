<?php

namespace App\Services;

use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

abstract class EloquentService implements BaseService
{
    /**
     * @var BaseRepository
     */
    protected BaseRepository $repository;

    public function all(): Collection|LengthAwarePaginator
    {
        if (request()->per_page == -1)
            return $this->repository->all();

        return $this->repository->paginate();
    }

    public function get(int $id): Model|null
    {
        return $this->repository->get($id);
    }

    public function getOrFail(int $id): Model
    {
        return $this->repository->getOrFail($id);
    }

    public function create(array $attributes): Model
    {
        return $this->repository->create($attributes);
    }

    public function update(int $id, array $attributes): Model
    {
        return $this->repository->update($id, $attributes);
    }

    public function save(Model $model, array $attributes): bool
    {
        return $this->repository->save($model, $attributes);
    }

    public function delete(int $id): bool
    {
        return $this->repository->delete($id);
    }

    public function deleteOrFail(int $id): bool
    {
        return $this->repository->deleteOrFail($id);
    }

    public function multipleDelete(array $ids): bool
    {
        return $this->repository->multipleDelete($ids);
    }

}

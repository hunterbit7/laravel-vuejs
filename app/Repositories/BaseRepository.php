<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface BaseRepository
{
    public function all(): Collection;

    public function paginate(): LengthAwarePaginator;

    public function get(int $id): Model|null;

    public function getOrFail(int $id): Model;

    public function create(array $attributes): Model;

    public function update(int $id, array $attributes): Model;

    public function save (Model $model, array $attributes): bool;

    public function delete(int $id): bool;

    public function deleteOrFail(int $id): bool;

    public function multipleDelete (array $ids): bool;
}

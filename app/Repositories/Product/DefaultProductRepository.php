<?php

namespace App\Repositories\Product;

use App\Models\Product\Product;
use App\Repositories\EloquentRepository;

class DefaultProductRepository extends EloquentRepository implements ProductRepository
{
    public function __construct (Product $product)
    {
        $this->model = $product;
    }

}

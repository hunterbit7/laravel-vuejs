<?php

namespace App\Services\Product;

use App\Repositories\Product\ProductRepository;
use App\Services\EloquentService;

class DefaultProductService extends EloquentService implements ProductService
{

    /**
     * Constructor.
     *
     * @param ProductRepository $productRepository
     */
    public function __construct (ProductRepository $productRepository)
    {
        $this->repository = $productRepository;
    }
}

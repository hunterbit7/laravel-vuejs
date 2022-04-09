<?php

namespace App\Http\Controllers\Api\Product;

use App\Http\Controllers\Api\CrudController;
use App\Http\Requests\Product\ProductStoreRequest;
use App\Http\Requests\Product\ProductUpdateRequest;
use App\Http\Resources\Product\ProductResource;
use App\Services\Product\ProductService;

class ProductController extends CrudController
{
    /**
     * Constructor.
     *
     * @param ProductService $productService
     */
    public function __construct (ProductService $productService)
    {
        parent::__construct();

        $this->service = $productService;
        $this->resource = ProductResource::class;
        $this->singularModel = 'Product';
        $this->pluralModel = 'Products';
        $this->table = 'products';
    }

    /**
     * @return ProductStoreRequest
     */
    public function storeRequest(): ProductStoreRequest
    {
        return app(ProductStoreRequest::class);
    }

    /**
     * @return ProductUpdateRequest
     */
    public function updateRequest(): ProductUpdateRequest
    {
        return app(ProductUpdateRequest::class);
    }
}

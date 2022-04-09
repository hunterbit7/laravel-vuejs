<?php

namespace App\ModelFilters\Product;

use EloquentFilter\ModelFilter;

class ProductFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    public $relations = [];

    public function productName($name)
    {
        if ($name || $name == 0)
            return $this->whereLike('name', $name);
    }

    public function productBarcode($barcode)
    {
        if ($barcode || $barcode == 0)
            return $this->whereLike('barcode', $barcode);
    }
}

<?php

namespace App\Models\Product;

use App\ModelFilters\Product\ProductFilter;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Product extends Model
{
    use HasFactory, Filterable, Sortable;

    protected $fillable = [
        'name',
        'barcode',
        'quantity',
        'price',
    ];

    public $sortable = [
        'name',
        'barcode',
        'quantity',
        'price',
        'created_at',
        'updated_at',
    ];

    /**
     * Product Filters.
     *
     * @return string
     */
    public function modelFilter(): string
    {
        return $this->provideFilter(ProductFilter::class);
    }
}

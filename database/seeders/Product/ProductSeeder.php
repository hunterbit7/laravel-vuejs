<?php

namespace Database\Seeders\Product;

use App\Models\Product\Product;
use App\Services\Product\ProductService;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * @var ProductService
     */
    protected $productService;

    /**
     * Constructor.
     *
     * @param ProductService $productService
     */
    public function __construct (ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Product::truncate();
        $products = [
            ['name' => 'Coca Cola', 'barcode' => '4539-7940', 'quantity' => 50, 'price' => 1.45],
            ['name' => 'Fanta', 'barcode' => '8239-8740', 'quantity' => 30, 'price' => 1.25],
            ['name' => 'Beer', 'barcode' => '9521-9091', 'quantity' => 40, 'price' => 0.95],
            ['name' => 'Wine', 'barcode' => '4478-7293', 'quantity' => 10, 'price' => 30],
            ['name' => 'Orange Juice', 'barcode' => '4011-1418', 'quantity' => 50, 'price' => 0.85],
            ['name' => 'Apple Juice', 'barcode' => '2806-0589', 'quantity' => 40, 'price' => 0.75],
            ['name' => 'Coffee', 'barcode' => '8311-4278', 'quantity' => 40, 'price' => 0.75],
            ['name' => 'Milk', 'barcode' => '0513-7395', 'quantity' => 35, 'price' => 0.85],
            ['name' => 'Tea', 'barcode' => '3924-9517', 'quantity' => 25, 'price' => 0.65],
            ['name' => 'Martini', 'barcode' => '4711-1761', 'quantity' => 25, 'price' => 15.25],
            ['name' => 'Whiskey Sour', 'barcode' => '7504-9394', 'quantity' => 15, 'price' => 35],
            ['name' => 'Negroni', 'barcode' => '6215-1832', 'quantity' => 14, 'price' => 45],
            ['name' => 'Margarita', 'barcode' => '9274-3410', 'quantity' => 25, 'price' => 14],
            ['name' => 'Cosmopolitan', 'barcode' => '1449-9555', 'quantity' => 20, 'price' => 50],
            ['name' => 'Moscow Mule', 'barcode' => '4868-3605', 'quantity' => 30, 'price' => 48],
            ['name' => 'Mojito', 'barcode' => '8213-0088', 'quantity' => 45, 'price' => 47],
            ['name' => 'Mai Tai', 'barcode' => '7753-4142', 'quantity' => 18, 'price' => 32],
            ['name' => 'Mint Julep', 'barcode' => '1059-3870', 'quantity' => 14, 'price' => 27],
            ['name' => 'Caipirinha', 'barcode' => '9897-4943', 'quantity' => 11, 'price' => 12],
            ['name' => 'Pina Colada', 'barcode' => '7310-9556', 'quantity' => 21, 'price' => 23],
            ['name' => 'Water', 'barcode' => '9260-7614', 'quantity' => 19, 'price' => 0.55],
            ['name' => 'Daiquiri', 'barcode' => '0689-6542', 'quantity' => 27, 'price' => 47],
            ['name' => 'Sidecar', 'barcode' => '3151-2981', 'quantity' => 14, 'price' => 41],
            ['name' => 'Whiskey Highball', 'barcode' => '4196-6990', 'quantity' => 35, 'price' => 52],
            ['name' => 'Flip', 'barcode' => '4655-7659', 'quantity' => 14, 'price' => 36],
        ];
        foreach ($products as $product) {
            $this->productService->create($product);
        }
    }
}

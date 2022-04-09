<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property $id
 * @property $name
 * @property $barcode
 * @property $quantity
 * @property $price
 * @property $description
 * @property $created_at
 * @property $updated_at
 */
class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'barcode' => $this->barcode,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'description' => $this->description,
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
        ];
    }
}

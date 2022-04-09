<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property $id
 * @property $name
 * @property $email
 * @property $created_at
 * @property $updated_at
 */

class UserResource extends JsonResource
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
            'email' => $this->email,
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
        ];
    }
}

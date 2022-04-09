<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'sometimes|required',
            'barcode' => 'sometimes|required|max:24',
            'quantity' => 'sometimes|required|integer|gt:0',
            'price'=> 'sometimes|required|numeric|gt:0|digits_between:1,11',
            'description' => '',
        ];
    }
}

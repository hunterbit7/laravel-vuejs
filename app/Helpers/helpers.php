<?php

use Illuminate\Support\Facades\Validator;

/**
 * @param $table
 * @return array
 */
function validate_ids ($table): array
{
    $rules = [
        'ids' => "required|array|exists:{$table},id",
        'ids.*' => 'integer',
    ];
    $validator = Validator::validate(request()->only('ids'), $rules);
    return array_values(array_unique($validator['ids']));
}

/**
 * @return int
 */
function items_per_page(): int
{
    $rules = [
        'per_page' => 'integer|min:5|max:50'
    ];
    $validator = Validator::validate(request()->only('per_page'), $rules);
    $perPage = 10;
    if (request()->has('per_page'))
        $perPage = $validator['per_page'];

    return $perPage;
}

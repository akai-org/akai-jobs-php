<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateJobOfferRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => [
                'sometimes',
                'string'
            ],
            'description' => [
                'sometimes',
                'string'
            ],
            'salary' => [
                'sometimes',
                'numeric'
            ],
            'start_date' => [
                'sometimes',
                'date'
            ],
            'end_date' => [
                'sometimes',
                'date'
            ],
            'area_id' => [
                'sometimes',
                'integer'
            ],
            'position' => [
                'sometimes',
                'string'
            ],
            'degree_id' => [
                'sometimes',
                'integer'
            ],
            'country' => [
                'sometimes',
                'string'
            ],
            'city' => [
                'sometimes',
                'string'
            ],
            'address' => [
                'sometimes',
                'string'
            ],
            'postal_code' => [
                'sometimes',
                'string'
            ]
        ];
    }
}

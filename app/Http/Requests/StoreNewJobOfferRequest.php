<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNewJobOfferRequest extends FormRequest
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
                'required',
                'string'
            ],
            'description' => [
                'required',
                'string'
            ],
            'start_date' => [
                'required',
                'date'
            ],
            'end_date' => [
                'required',
                'date'
            ],
            'area_id' => [
                'required',
                'integer'
            ],
            'position_id' => [
                'required',
                'integer'
            ],
            'degree_id' => [
                'required',
                'integer'
            ],
            'country' => [
                'required',
                'string'
            ],
            'city' => [
                'required',
                'string'
            ],
            'address' => [
                'required',
                'string'
            ],
            'postal_code' => [
                'required',
                'stirng'
            ]
        ];
    }
}

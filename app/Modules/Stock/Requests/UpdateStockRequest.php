<?php

namespace App\Modules\Stock\Requests;

class UpdateStockRequest extends AbstractRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'unit_price' => ['required', 'numeric', 'between:0,999.99'],
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'unit_price.required' => 'Unit price is required!',
            'unit_price.numeric' => 'Unit price must be a number.',
        ];
    }
}

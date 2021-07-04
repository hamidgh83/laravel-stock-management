<?php

namespace App\Modules\Stock\Requests;

class CreateClientStockRequest extends AbstractRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'volume' => ['required', 'integer', 'min:1'],
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
            'volume.required' => 'Volume is required!',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoomRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'capacity'    => 'required|integer',
            'price'       => 'required|numeric|between:0,99',
            'day_price_0' => 'numeric|between:0,99|nullable',
            'day_price_1' => 'numeric|between:0,99|nullable',
            'day_price_2' => 'numeric|between:0,99|nullable',
            'day_price_3' => 'numeric|between:0,99|nullable',
            'day_price_4' => 'numeric|between:0,99|nullable',
            'day_price_5' => 'numeric|between:0,99|nullable',
            'day_price_6' => 'numeric|between:0,99|nullable',
        ];
    }
}

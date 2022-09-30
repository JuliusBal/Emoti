<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreHotelRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'             => 'required|string',
            'rooms'            => 'required|array',
            'rooms.*'          => 'required|array',
            'rooms.*.capacity' => 'required|integer',
            'rooms.*.price'    => 'required|integer',
        ];
    }
}

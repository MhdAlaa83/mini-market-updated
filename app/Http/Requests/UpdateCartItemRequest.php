<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCartItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // qty = 0 means remove the item
            'qty' => ['required', 'integer', 'min:0', 'max:999'],
        ];
    }
}

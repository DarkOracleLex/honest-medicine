<?php

namespace App\Http\Requests\Item;

use Illuminate\Foundation\Http\FormRequest;

class UpdateItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['string', 'max:255'],
            'key' => ['string', 'max:25'],
        ];
    }
}

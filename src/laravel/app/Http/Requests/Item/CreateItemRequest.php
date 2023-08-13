<?php

namespace App\Http\Requests\Item;

use Illuminate\Foundation\Http\FormRequest;

class CreateItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'key' => ['required', 'string', 'max:25'],
        ];
    }
}

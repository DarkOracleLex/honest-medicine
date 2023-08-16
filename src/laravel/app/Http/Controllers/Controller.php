<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected function success(mixed $data = null, ?string $message = null)
    {
        return [
            'is_success' => true,
            'message' => $message,
            'data' => $data,
        ];
    }
}

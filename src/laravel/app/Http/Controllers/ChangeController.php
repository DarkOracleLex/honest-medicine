<?php

namespace App\Http\Controllers;

use App\Models\Change;

class ChangeController extends Controller
{
    public function index()
    {
        return $this->success(Change::all());
    }
}

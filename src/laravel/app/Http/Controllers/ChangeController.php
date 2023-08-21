<?php

namespace App\Http\Controllers;

use App\Services\ChangeService;

class ChangeController extends Controller
{
    private ChangeService $changeService;

    public function __construct()
    {
        $this->changeService = new ChangeService();
    }

    public function index()
    {
        return $this->success($this->changeService->findAll());
    }
}

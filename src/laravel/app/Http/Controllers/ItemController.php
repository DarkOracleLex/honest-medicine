<?php

namespace App\Http\Controllers;

use App\Http\Requests\Item\CreateItemRequest;
use App\Http\Requests\Item\UpdateItemRequest;
use App\Services\ItemService;

class ItemController extends Controller
{
    private ItemService $itemService;

    public function __construct()
    {
        $this->itemService = new ItemService();
    }

    public function index()
    {
        return $this->success($this->itemService->findAll());
    }

    public function show(int $item)
    {
        return $this->success($this->itemService->findOne($item));
    }

    public function store(CreateItemRequest $request)
    {
        return $this->success($this->itemService->create($request->validated()));
    }

    public function update(UpdateItemRequest $request, int $item)
    {
        return $this->success($this->itemService->update($request->validated(), $item));
    }

    public function destroy(int $item)
    {
        return $this->success($this->itemService->delete($item));
    }
}

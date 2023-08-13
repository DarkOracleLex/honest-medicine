<?php

namespace App\Http\Controllers;

use App\Http\Requests\Item\CreateItemRequest;
use App\Http\Requests\Item\UpdateItemRequest;
use App\Models\Item;

class ItemController extends Controller
{
    public function index()
    {
        return Item::all();
    }

    public function store(CreateItemRequest $request)
    {
        return Item::create($request->validated());
    }

    public function show(Item $item)
    {
        return $item;
    }

    public function update(UpdateItemRequest $request, Item $item)
    {
        $item->update($request->validated());

        return $item;
    }

    public function destroy(Item $item)
    {
        $item->delete();

        return response()->json();
    }
}

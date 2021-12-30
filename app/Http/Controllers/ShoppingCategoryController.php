<?php

namespace App\Http\Controllers;

use App\Models\Shopping;
use App\Models\ShoppingCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ShoppingCategoryController extends Controller
{
    public function index()
    {
        return view('shopcat.index');
    }
    public function getAllShopCat(): JsonResponse
    {
        $shopcat = ShoppingCategory::all();
        return response()->json($shopcat);
    }
    public function add()
    {
        return view('shopcat.add');
    }
    public function store(Request $request): JsonResponse
    {
        $shoppingcat = new ShoppingCategory();
        $shoppingcat->fill($request->all());
        $shoppingcat->save();
        return new JsonResponse(['icon'=>'success', 'title' =>'Success', 'message'=>'Bill  added successfully']);

    }
    public function getShopCat($id): JsonResponse
    {
        $shopcat = ShoppingCategory::find($id);
        return response()->json($shopcat);
    }

}

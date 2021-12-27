<?php

namespace App\Http\Controllers;

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

}

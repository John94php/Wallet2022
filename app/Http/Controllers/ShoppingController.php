<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Shopping;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShoppingController extends Controller
{
    //
    public function index()
    {
        return view('shopping.index');
    }
    public function add()
    {
        return view('shopping.add');
    }
    public  function store(Request $request): JsonResponse
    {

        $shopping = new Shopping();
        $shopping->fill($request->all());
        $shopping->save();
        return new JsonResponse(['icon'=>'success', 'title' =>'Success', 'message'=>'Bill  added successfully']);



    }
    public function getAllShopping(): JsonResponse
    {
        $shopping = Shopping::all();
        return response()->json($shopping);
    }
    public function countShopping(): JsonResponse
    {
        $shopping = Shopping::all()->count();
        return response()->json($shopping);
    }
    public function getAllShoppingAmount(): JsonResponse
    {
        $amount = Shopping::select(DB::raw('SUM(total) AS sum'))->pluck('sum');
        return response()->json($amount);
    }

}

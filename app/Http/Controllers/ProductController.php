<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function  index()
    {
        return view('products/index');
    }
    public function add()
    {
        return view('products/add');
    }
    public function store(Request $request): JsonResponse
    {
        $data = $request->input('product_name');
        $prod = Product::where('name','=',$data)->first();
        if($prod !== null)
        {
            return response()->json(['icon'=>'error','title' =>'Error !!','message'=>'This Category exist !!']);
        } else {
            $product = new Product();
            $product->name = $data;
            $product->save();
            return new JsonResponse(['icon'=>'success', 'title' =>'Success', 'message'=>'Product '.$data.' added successfully']);

        }

    }
    public function getAllProducts(): JsonResponse
    {
        $products = Product::all();
        return response()->json($products);
    }
    public function countProducts(): JsonResponse
    {
        $products_count = Product::all()->count();
        return response()->json($products_count);
    }
}

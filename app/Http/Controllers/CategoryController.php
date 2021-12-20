<?php

namespace App\Http\Controllers;

use App\Models\Category;
use http\Env\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return view('categories.index');
    }
    public function getAllCategories():JsonResponse
    {
        $categories = Category::all();
        return response()->json($categories);
    }
    public function add()
    {
        return view('categories/add');
    }
    public function store(Request  $request): JsonResponse
    {
        $data = $request->input('category_name');
        $cat = Category::where('name','=',$data)->first();
        if($cat !== null)
        {
            return response()->json(['icon'=>'error','title' =>'Error !!','message'=>'This Category exist !!']);
        } else {
            $category = new Category();
            $category->name = $data;
            $category->save();
            return new JsonResponse(['icon'=>'success', 'title' =>'Success', 'message'=>'Category '.$data.' added successfully']);

        }

    }
    public function countCategories():JsonResponse
    {
        $categories = Category::all()->count();
        return response()->json($categories);
    }
}

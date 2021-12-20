<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BillController extends Controller
{
    public function index()
    {
        return view('bills.index');
    }
    public function add()
    {
        return view('bills/add');
    }
    public function store(Request $request)
    {
        $bill = new Bill();
        $bill->fill($request->all());
        $bill->save();
        return new JsonResponse(['icon'=>'success', 'title' =>'Success', 'message'=>'Bill  added successfully']);
    }
    public function getAllBills()
    {
        $bills = Bill::all();
        return response()->json($bills);
    }
}

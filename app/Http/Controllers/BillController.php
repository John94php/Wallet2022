<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Status;
use http\Env\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    public function store(Request $request): JsonResponse
    {
        $bill = new Bill();
        $bill->fill($request->all());
        $bill->save();
        return new JsonResponse(['icon'=>'success', 'title' =>'Success', 'message'=>'Bill  added successfully']);
    }
    public function getAllBills(): JsonResponse
    {
        $bills = Bill::all();
        return response()->json($bills);
    }
    public function getAllBillsAmount(): JsonResponse
    {
        $amount = Bill::select(DB::raw('SUM(amount) AS sum'))->pluck('sum');
        return response()->json($amount);
    }
    public function countBills() : JsonResponse
    {
        $count = Bill::all()->count();
        return response()->json($count);
    }

}

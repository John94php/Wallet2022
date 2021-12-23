<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Shopping;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExpenseController extends Controller
{
        public function countAllExpenses(): JsonResponse
        {
            $amount = Shopping::select(DB::raw('SUM(total) AS total'))->pluck('total');
            $amount_1 = Bill::select(DB::raw('SUM(amount) AS amount'))->pluck('amount');
            return response()->json(['shopping' =>$amount,'bills' =>$amount_1]);
        }
}

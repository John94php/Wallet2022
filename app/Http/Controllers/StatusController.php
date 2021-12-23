<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function getStatus($id): JsonResponse
    {
        $status = Status::find($id);
        return response()->json($status);
    }
    public function getAllStatuses()
    {
        $statuses = Status::all();
        return response()->json($statuses);
    }
}

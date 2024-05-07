<?php

namespace App\Http\Controllers;
use App\Http\Requests\ListBatchesRequest;
use Illuminate\Support\Facades\DB;

class BatchesController extends Controller
{
    public function index(ListBatchesRequest $request)
    {
        $batches = DB::table('job_batches')->where('name', 'files')->get();

        return response()->json(['success' => true, 'data' => $batches], 200);
    }
}

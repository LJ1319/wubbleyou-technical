<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNumberRequest;
use App\Jobs\ProcessNumbersJob;
use Illuminate\Http\Request;

class NumberController extends Controller
{
    public function store(StoreNumberRequest $request)
    {
        $numbers = $request->validated()['numbers'];
        $chunks = array_chunk($numbers, 100);

        foreach ($chunks as $chunk) {
            ProcessNumbersJob::dispatch($chunk);
        }

        return response()->json([
            'success' => true,
        ], 202);
    }
}

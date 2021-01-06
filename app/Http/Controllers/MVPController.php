<?php

namespace App\Http\Controllers;

use App\Services\MVPService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MVPController extends Controller
{
    public function MVP(Request $request, MVPService $MVPService): JsonResponse
    {
       $winner = $MVPService->MVPProccess($request);
        return response()->json(['status' => 'success', 'data' => ['MVP' => $winner]], 200);
    }
}

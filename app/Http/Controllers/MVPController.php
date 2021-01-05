<?php

namespace App\Http\Controllers;

use App\Services\MVPService;
use Illuminate\Http\Request;

class MVPController extends Controller
{
    public function MVP(Request $request, MVPService $MVPService)
    {
       $winner = $MVPService->MVPProccess($request);
    }
}

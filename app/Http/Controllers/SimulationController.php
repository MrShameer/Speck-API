<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Models\Simulation;

class SimulationController extends Controller
{
    public function info(Request $request){
        $info = Simulation::where([['owner', $request->user()->id],['name',$request['name']]])->first();
        $info = $info->makeHidden(['id','owner']);
        return Response::json($info, 200);
    }
}



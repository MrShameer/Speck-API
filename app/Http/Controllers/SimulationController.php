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

    public function list(Request $request){
        $list = Simulation::where('owner', $request->user()->id)->get('name');
        return response()->json([
            'sims' => $list
        ], 200);
    }

    public function insertInfo(Request $request){
        $simulation = Simulation::create([
            'owner' => $request->user()->id,
            'name' => $request['name'],
            'total_npc' => $request['total_npc'],
            'duration' => $request['duration'],
            'with_mask' => $request['with_mask'],
            'npc_spawn_interval' => $request['npc_spawn_interval'],
        ]);

        if($simulation){
            return response()->json([
                'message' => 'Simulation info stored successfully',
                'insert' => true,
            ], 200);
        }
        return response()->json([
            'message' => 'Simulation info failed to store',
            'insert' => false,
        ], 400);
    }
}



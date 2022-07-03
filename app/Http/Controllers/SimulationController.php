<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Models\Simulation;

class SimulationController extends Controller
{
    public function info(Request $request){
        $info = Simulation::where([['owner', $request->user()->id],['id',$request['id']]])->first();
        $info = $info->makeHidden('owner');
        return Response::json($info, 200);
    }

    public function list(Request $request){
        $list = Simulation::where('owner', $request->user()->id)->get(['id','name']);
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
                'message' => 'Maklumat Simulasi Berjaya Disimpan',
                'insert' => true,
            ], 200);
        }
        return response()->json([
            'message' => 'Maklumat Simulasi Gagal Disimpan',
            'insert' => false,
        ], 400);
    }

    public function deleteInfo(Request $request){
        $simulation = Simulation::where([['owner', $request->user()->id],['id',$request['id']]])->first();
        if($simulation){
            $simulation->delete();
            return response()->json([
                'message' => 'Maklumat Simulasi Berjaya Dipadamkan',
                'delete' => true,
            ], 200);
        }
        return response()->json([
            'message' => 'Maklumat Simulasi Gagal Dipadamkan',
            'delete' => false,
        ], 400);
    }

}



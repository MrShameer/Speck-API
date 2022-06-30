<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SimulationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('simulations')->insert([
            'owner' => '1',
            'name' => 'Train 1', 
            'total_npc' => '100',
            'duration' => '1.5',
            'with_mask' => '20',
            'npc_spawn_interval' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}

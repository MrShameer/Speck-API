<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Simulation extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner',
        'name',
        'total_npc',
        'total_infected',
        'duration',
        'with_mask',
    ];

    protected $casts = [
        'created_at' => 'date',
        'updated_at' => 'date',
    ];
}

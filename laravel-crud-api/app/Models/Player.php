<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    //add name and email
    protected $fillable = ['name', 'email'];

    // Define the relationship with Team
    public function teams()
    {
        return $this->belongsToMany(Teams::class, 'player_team', 'player_id', 'team_id');
    }
}

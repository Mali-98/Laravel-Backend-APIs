<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teams extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description'];

    public function players()
    {
        return $this->belongsToMany(Player::class, 'player_team', 'team_id', 'player_id');
    }
}

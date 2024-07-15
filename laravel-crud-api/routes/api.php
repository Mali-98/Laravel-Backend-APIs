<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\TeamPlayerController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/players', [PlayerController::class,'index']);
Route::post('/players', [PlayerController::class,'store']);
Route::get('players/{player}', [PlayerController::class,'show']);
Route::patch('players/{player}', [PlayerController::class,'update']);
Route::delete('players/{player}', [PlayerController::class,'destroy']);


Route::get('/teams', [TeamController::class,'index']);
Route::post('/teams', [TeamController::class,'store']);
Route::get('teams/{team}', [TeamController::class,'show']);
Route::patch('teams/{team}', [TeamController::class,'update']);
Route::delete('teams/{team}', [TeamController::class,'destroy']);



Route::post('teams/{team}/players', [TeamPlayerController::class, 'addPlayerToTeam']);
Route::delete('teams/{team}/players/{player}', [TeamPlayerController::class, 'removePlayerFromTeam']);
Route::get('teams/{team}/players', [TeamPlayerController::class, 'getPlayersInTeam']);
Route::put('teams/{team}/players/{player}', [TeamPlayerController::class, 'addExistingPlayerToTeam']);
Route::get('players/{player}/teams', [TeamPlayerController::class, 'getTeamsForPlayer']);


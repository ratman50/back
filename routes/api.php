<?php

use App\Http\Controllers\AnneeController;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\DisciplineController;
use App\Http\Controllers\EleveController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\NiveauController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware' => ['auth:sanctum']], function() {
    Route::apiResource("evenements",EventController::class);
    Route::post("classe/{classe}/discipline/{discipline}/eval/{eval}",[ClasseController::class,"addNote"]);
    Route::get("classe/{classe}/disciplines/{discipline}/notes",[ClasseController::class,"getNoteByDiscipline"]);
    Route::get("classe/{classe}/notes",[ClasseController::class,"getNote"]);
    Route::get("classe/{classe}/notes/eleves/{eleve}",[ClasseController::class,"getNote"]);
    Route::post("classe/{classe}/coeff",[ClasseController::class, "addCoeff"]);
    Route::post("classe/{classe}/discipline",[DisciplineController::class, "addDiscipline"]);
    Route::apiResource("users", UserController::class);
    Route::apiResource("annee", AnneeController::class);
    Route::apiResource("niveau",NiveauController::class);
    Route::apiResource("classe",ClasseController::class);
    Route::apiResource("discipline", DisciplineController::class);
});
Route::get("user/{user}/evenements", [UserController::class, "getEventByUser"]);
Route::get("eleve/{eleve}/participations", [EleveController::class, "getPartByEleve"]);
Route::apiResource("eleve",EleveController::class);
Route::post('login',[AuthController::class,"login"]);
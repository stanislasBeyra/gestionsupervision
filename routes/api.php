<?php

use App\Http\Controllers\FormSelectedController;
use App\Http\Controllers\SupervisionController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/domaines', [FormSelectedController::class, 'getDomaines']);
Route::get('/contenus', [FormSelectedController::class, 'getContenus']);
Route::get('/questions', [FormSelectedController::class, 'getQuestions']);
Route::get('/methodes', [FormSelectedController::class, 'getMethodes']);
Route::get('/notes', [FormSelectedController::class, 'getNotes']);


Route::prefix('supervisions')->group(function () {
    Route::get('/getallsup', [SupervisionController::class, 'getallsupervision']);
    Route::post('/AddSup', [SupervisionController::class, 'AddSupervision']);
    Route::delete('/DeleteSup/{id}', [SupervisionController::class, 'DeleteSupervision']);
});

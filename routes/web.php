<?php

use App\Http\Controllers\FormSelectedController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/Mdbcode',function(){
    return view('Mdbcode');
});

Route::get('dashboard',function(){
return view('dashboard');
});

// Route::get('{page}',[HomeController::class,'getpage'])->name('name.page');

Route::get('{page}',[HomeController::class,'pageviews'])->name('name.page');


Route::get('/nomm',[FormSelectedController::class,'getDomaines']);
Route::get('/domaines', [FormSelectedController::class, 'getDomaines']);
Route::get('/contenus', [FormSelectedController::class, 'getContenus']);
Route::get('/questions', [FormSelectedController::class, 'getQuestions']);
Route::get('/methodes', [FormSelectedController::class, 'getMethodes']);
Route::get('/notes', [FormSelectedController::class, 'getNotes']);

// Route pour tout récupérer en une fois
Route::get('/all-selects', [FormSelectedController::class, 'getAllSelects']);

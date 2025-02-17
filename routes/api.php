<?php

use App\Http\Controllers\AllQuestionController;
use App\Http\Controllers\ContenuController;
use App\Http\Controllers\DomaineController;
use App\Http\Controllers\EtablissementController;
use App\Http\Controllers\FormSelectedController;
use App\Http\Controllers\MethodeController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\ProblemeController;
use App\Http\Controllers\SuperviserController;
use App\Http\Controllers\SuperviseurController;
use App\Http\Controllers\SupervisionController;
use App\Http\Controllers\SupervisionsController;
use App\Http\Controllers\SyntheseController;
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
    Route::post('/DeleteSup/{id}', [SupervisionController::class, 'DeleteSupervision']);
});


Route::prefix('allquestion')->group(function () {
    Route::controller(AllQuestionController::class)->group(function () {
        Route::get('', 'getquestion');
        Route::post('save', 'SaveQuestion');
        Route::post('update', 'updateQuestion');
        Route::post('delete', 'deleteQuestion');
    });
});


Route::prefix('contenu')->group(function () {
    Route::controller(ContenuController::class)->group(function () {
        Route::get('', 'getContenu');
        Route::post('save', 'saveContenu');
        Route::post('update', 'updateContenu');
        Route::post('delete', 'deleteContenu');
    });
});

Route::prefix('domaine')->group(function () {
    Route::controller(DomaineController::class)->group(function () {
        Route::get('', 'getDomaine');
        Route::post('save', 'saveDomaine');
        Route::post('update', 'updateDomaine');
        Route::post('delete', 'deleteDomaine');
    });
});


Route::prefix('methodes')->group(function () {
    Route::controller(MethodeController::class)->group(function () {
        Route::get('', 'getMethode');
        Route::post('save', 'saveMethode');
        Route::post('update', 'updateMethode');
        Route::post('delete', 'deleteMethode');
    });
});

Route::prefix('supervision')->group(function () {
    Route::controller(SupervisionsController::class)->group(function () {
        Route::get('', 'getSupervision');
        Route::get('/environnementElement','getEnvironnementElement');
        Route::get('/competanceElement','getCompetanceElement');
        Route::post('save', 'saveSupervision');
        Route::post('update', 'updateSupervision');
        Route::post('delete', 'deleteSupervision');
    });
});


Route::prefix('note')->group(function () {
    Route::controller(NoteController::class)->group(function () {
        Route::get('', 'getNote');
        Route::post('save', 'saveNote');
        Route::post('update', 'updateNote');
        Route::post('delete', 'deleteNote');
    });
});

Route::prefix('syntheses')->group(function () {
    Route::controller(SyntheseController::class)->group(function () {
        Route::get('', 'getallsyntese');
        Route::post('save', 'saveSynthese');
    });
});

Route::prefix('problemes')->group(function () {

    Route::controller(ProblemeController::class)->group(function () {
        Route::get('', 'getProbleme');
        Route::post('save', 'saveProbleme');
    });
});

Route::prefix('etablissements')->group(function () {
    Route::controller(EtablissementController::class)->group(function () {
        Route::get('', 'getEtablissements');
        Route::post('save', 'saveEtablissement');
    });
});

Route::prefix('superviseurs')->group(function () {
    Route::controller(SuperviseurController::class)->group(function () {
        Route::get('', 'getSuperviseurs');
        Route::post('save', 'saveSuperviseur');
    });
});

Route::prefix('supervisers')->group(function () {
    Route::controller(SuperviserController::class)->group(function () {
        Route::get('', 'getSupervisers');
        Route::post('save', 'saveSuperviser');
    });
});

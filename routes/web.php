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


Route::get('/manifest.json', function () {
    return response()->json([
        'name' => 'Supervision Sanitaire',
        'short_name' => 'MTN',
        'description' => 'Application de supervision des établissements sanitaires et gestion des problèmes prioritaires',
        'start_url' => '/dashboard',
        'display' => 'standalone',
        'background_color' => '#ffffff',
        'theme_color' => '#2979ff',
        'orientation' => 'portrait',
        'scope' => '/',
        'lang' => 'fr',
        'dir' => 'ltr',
        'icons' => [
            [
                'src' => asset('icons/icon-144.png'),
                'sizes' => '144x144',
                'type' => 'image/png',
                'purpose' => 'any'
            ],
            [
                'src' => asset('icons/icon-144.png'),
                'sizes' => '192x192',
                'type' => 'image/png',
                'purpose' => 'any'
            ],
            [
                'src' => asset('icons/icon-144.png'),
                'sizes' => '512x512',
                'type' => 'image/png',
                'purpose' => 'any'
            ],
            [
                'src' => asset('icons/maskable-192.png'),
                'sizes' => '192x192',
                'type' => 'image/png',
                'purpose' => 'maskable'
            ],
            [
                'src' => asset('icons/maskable-512.png'),
                'sizes' => '512x512',
                'type' => 'image/png',
                'purpose' => 'maskable'
            ]
        ],
        'shortcuts' => [
            [
                'name' => 'Dashboard',
                'short_name' => 'Dashboard',
                'description' => 'Accéder au tableau de bord principal',
                'url' => '/dashboard',
                'icons' => [
                    [
                        'src' => asset('icons/dashboard.png'),
                        'sizes' => '192x192',
                        'type' => 'image/png'
                    ]
                ]
            ],
            [
                'name' => 'Synthèse supervision',
                'short_name' => 'Synthèse',
                'description' => 'Consulter la synthèse des supervisions',
                'url' => '/synthesesupervision',
                'icons' => [
                    [
                        'src' => asset('icons/chart.png'),
                        'sizes' => '192x192',
                        'type' => 'image/png'
                    ]
                ]
            ],
            [
                'name' => 'Problèmes prioritaires',
                'short_name' => 'Problèmes',
                'description' => 'Accéder aux problèmes prioritaires',
                'url' => '/problemeprioritaire',
                'icons' => [
                    [
                        'src' => asset('icons/icon-144.png'),
                        'sizes' => '192x192',
                        'type' => 'image/png'
                    ]
                ]
            ]
        ],
        'categories' => ['healthcare', 'utilities', 'productivity'],
        'prefer_related_applications' => false
    ]);
})->name('manifest');

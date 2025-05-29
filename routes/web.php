<?php

use App\Http\Controllers\FormSelectedController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

// Routes publiques
Route::get('/', function () {
    if (auth()->check()) {
        return redirect('/dashboard');
    }
    return redirect('/login');
});

// Routes d'authentification
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Routes protégées
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    Route::get('/profile', function() {
        return view('profile.show');
    })->name('profile');

    Route::get('/dashboard', function() {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/Mdbcode', function() {
        return view('Mdbcode');
    });

    Route::get('{page}', [HomeController::class, 'pageviews'])->name('name.page');

    // Routes pour les formulaires
    Route::get('/nomm', [FormSelectedController::class, 'getDomaines']);
    Route::get('/domaines', [FormSelectedController::class, 'getDomaines']);
    Route::get('/contenus', [FormSelectedController::class, 'getContenus']);
    Route::get('/questions', [FormSelectedController::class, 'getQuestions']);
    Route::get('/methodes', [FormSelectedController::class, 'getMethodes']);
    Route::get('/notes', [FormSelectedController::class, 'getNotes']);
    Route::get('/all-selects', [FormSelectedController::class, 'getAllSelects']);
});

// Route du manifest (publique)
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


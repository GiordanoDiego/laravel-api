<?php

use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\MainController;
use App\Http\Controllers\Admin\MainController as AdminMainController;


//importo controller
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\Admin\TechnologyController;




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

// php artisan route:list        mostra tutte le rotte definite

Route::get('/', [MainController::class, 'index'])->name('home');


Route::prefix('admin')
    ->name('admin.')
    ->middleware('auth')
    ->group(function () {

    Route::get('/dashboard', [AdminMainController::class, 'dashboard'])->name('dashboard');
    
    //definisco tutte le 7 rotte per projects
    Route::resource('project', ProjectController::class);
    //definisco tutte le 7 rotte per types
    Route::resource('type', TypeController::class);

    Route::resource('technologies', TechnologyController::class);
    // php artisan route:list mostra tutte le rotte definite
});

require __DIR__.'/auth.php';

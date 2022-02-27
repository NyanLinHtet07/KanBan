<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\StatusController;
use Inertia\Inertia;



// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

//redirect login page when user view index page

Route::get ('/' , function() {
    return redirect()->route('login');
} );

//to main dash

// Route::get('/dash' , function() {
//     return Inertia::render('Main');
// }) -> middleware(['auth' ,'verified'])->name('dash');

// for Kanban Board 

Route::middleware(['auth'])->group(function () {

    Route::get('/dash' , [ DataController::class, 'index']) -> name('dash');
    Route::post('/datas', [ DataController::class, 'store']) -> name('datas.store');
    Route::put('/datas/update/{id}' , [DataController::class, 'update']) -> name('data.update');
    Route::delete('/datas/{id}' , [DataController::class, 'destroy']) -> name('data.destroy');

    Route::put('/datas/sync' , [DataController::class, 'sync']) -> name('datas.sync');
    Route::put('/datas/{data}' , [DataController::class, 'updateData']) -> name('datas.updatestatus');
   

    Route::get('/statuses' , [StatusController::class, 'index']) -> name('statuses.index');
    Route::post('/statuses' , [StatusController::class, 'store']) -> name('statuses.store');
    Route::put('/statuses/update/{id}' ,  [StatusController::class , 'update']) -> name('statuses.update');
    Route::delete('/statuses/delete/{id}', [StatusController::class , 'destroy']) -> name ('statuses.delete');
});

require __DIR__.'/auth.php';

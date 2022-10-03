<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\OverBudgetController;
use App\Http\Controllers\RabsController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\ToolsController;
use App\Http\Controllers\WorkController;
use App\Http\Controllers\WorkersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('login', [
        'page_name' => 'Login'
    ]);
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);


Route::middleware(['auth:web'])
->prefix('admin')
->group(function () {
    Route::post('logout',[LoginController::class, 'logout']);
    Route::resource('dashboard', DashboardController::class);
    Route::resource('salary', SalaryController::class);
    Route::resource('material', MaterialController::class);
    Route::resource('overbudget', OverBudgetController::class);
    Route::resource('rabs', RabsController::class);
    Route::resource('tool', ToolsController::class);
    Route::resource('work', WorkController::class);
    Route::resource('workers', WorkersController::class);
});



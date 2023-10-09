<?php

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
    return view('welcome');
});

Route::get('/input', function () {
    return view('input_form');
});

// routes/web.php

use App\Http\Controllers\ApiController;

Route::get('/', [ApiController::class, 'showForm'])->name('/');
Route::get('/api-result', [ApiController::class, 'getApiResult'])->name('api.result');
Route::post('/sql-result', [ApiController::class, 'executeStoredProcedure'])->name('execute.stored.procedure');
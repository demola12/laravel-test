<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\WebsiteController;


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

Route::middleware('auth.token')->get('/me', function (Request $request) {
    return $request->user();
});
Route::middleware('auth.token')->group(function ($router) {
    Route::post('websites/{id}/vote', [WebsiteController::class, 'vote']);
    Route::post('websites', [WebsiteController::class, 'store']);
    Route::group(['middleware' => ['can:delete']], function () { 
        Route::delete('websites/{id}', [WebsiteController::class, 'destroy']);

     });

});
Route::controller(AuthController::class)->group(function ($router) {
    Route::post('register', 'register')->name('register');
    Route::post('admin/register', 'register_admin')->name('register_admin');
    Route::post('login', 'login')->name('login');
    Route::post('logout', 'logout')->name('logout')->middleware('auth.token');
    Route::post('refresh', 'refresh')->name('refresh');
});
Route::get('categories', [CategoryController::class, 'index']);
Route::get('websites', [WebsiteController::class, 'index']);


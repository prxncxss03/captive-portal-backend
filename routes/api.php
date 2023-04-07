<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\PendingAccountController;

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
Route::post('/auth/register', [UserAuthController::class, 'register']);
Route::post('/auth/login', [UserAuthController::class, 'login']);
Route::group(['middleware' => ['auth:api']], function () {
    Route::get('/admin/pending-accounts', [PendingAccountController::class, 'index']);
    Route::get('admin/students/search/{key}', [SearchController::class, 'studentSearch']);
    Route::get('admin/students', [StudentController::class, 'index']);
    Route::delete('admin/students/{id}', [StudentController::class, 'delete']);
});
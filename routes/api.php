<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\PendingAccountController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\WebContentFilter;

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
    //admin routes
    Route::get('/admin/pending-accounts', [PendingAccountController::class, 'index']);
    Route::put('/admin/pending-accounts/{id}', [PendingAccountController::class, 'approve']);
    Route::put('/admin/pending-accounts', [PendingAccountController::class, 'approveAll']);
    Route::delete('/admin/pending-accounts', [PendingAccountController::class, 'rejectAll']);
    Route::delete('/admin/pending-accounts/{id}', [PendingAccountController::class, 'reject']);
    Route::get('admin/pending-accounts/search/{key}', [SearchController::class, 'pendingAccountsSearch']);
    Route::get('admin/students/search/{key}', [SearchController::class, 'studentSearch']);
    Route::get('admin/students', [StudentController::class, 'index']);
    Route::delete('admin/students/{id}', [StudentController::class, 'delete']);
    Route::get('admin/faculty', [FacultyController::class, 'index']);
    Route::delete('admin/faculty/{id}', [FacultyController::class, 'delete']);
    Route::get('admin/faculty/search/{key}', [SearchController::class, 'facultySearch']);
    Route::put('/user/setting/update/{id}',[SettingsController::class, 'editInformation']);
    Route::put('/user/setting/update-password/{id}',[SettingsController::class, 'resetPassword']);

    Route::get('/admin/web-content-filter', [WebContentFilter::class, 'index']);
    Route::post('/admin/web-content-filter', [WebContentFilter::class, 'addWebsite']);

    Route::get('/auth/check-auth', [PendingAccountController::class, 'checkAuth']);

});


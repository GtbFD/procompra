<?php

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

Route::get('/', [\App\Http\Controllers\UserController::class, 'autentication'])
    ->name('autentication-page');

Route::post('/autenticate', [\App\Http\Controllers\UserController::class, 'autenticate'])
    ->name('user-autenticate');

Route::get('/registration', [\App\Http\Controllers\UserController::class, 'registration'])
    ->name('registration');
Route::post('/registrate', [\App\Http\Controllers\UserController::class, 'registrate'])
    ->name('user-registrate');

Route::prefix('/company')->group(function () {
    Route::get('/registration', [\App\Http\Controllers\CompanyController::class,
        'registration'])->name('company-registration');

    Route::post('/registrate', [\App\Http\Controllers\CompanyController::class,
        'registrate'])->name('registrate-company');
});


Route::prefix('/dashboard')->group(function () {
    Route::get('/', [\App\Http\Controllers\UserController::class, 'authorization'])
        ->name('authorization');

    Route::get('/logout', [\App\Http\Controllers\UserController::class, 'logout'])
        ->name('logout');
});

Route::prefix('/company')->group(function () {
    Route::post('/search/{razao_social?}', [\App\Http\Controllers\CompanyController::class, 'show'])
        ->name('search-company');

    Route::get('/edit/{id?}', [\App\Http\Controllers\CompanyController::class, 'editCompany'])
        ->name('edit-company');

    Route::put('/edit/{id?}', [\App\Http\Controllers\CompanyController::class, 'edit'])
        ->name('complete-edit-company');

    Route::get('/delete/{id?}', [\App\Http\Controllers\CompanyController::class, 'delete'])
        ->name('delete-company');

    Route::get('/all', [\App\Http\Controllers\CompanyController::class, 'showAll'])
        ->name('show-companies');

    Route::post('/document', [\App\Http\Controllers\CompanyController::class, 'createDocumentTo'])
        ->name('create-company-document');

    Route::get('/document/{id?}', [\App\Http\Controllers\CompanyController::class, 'allDocumentsFrom'])
        ->name('company-documents');
});

Route::prefix('/document')->group(function() {
    Route::get('/create', [\App\Http\Controllers\DocumentController::class, 'create'])
    ->name('create-document');

    Route::post('/create/finish', [\App\Http\Controllers\DocumentController::class, 'createDocument'])
        ->name('finish-creation');

    Route::get('/create/external', [\App\Http\Controllers\DocumentController::class, 'createExternal'])
        ->name('create-external-document');
});

Route::prefix('/erro')->group(function () {
    Route::get('/{redirectRoute?}', function ($redirectRoute){
        return view('error', ['redirectRoute' => $redirectRoute]);
    })->name('erro');
});

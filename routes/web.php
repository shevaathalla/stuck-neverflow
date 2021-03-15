<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\QuestionController;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::prefix('question')->group(function () {
    Route::get('/',[QuestionController::class,'index'])->name('question.index');
    Route::post('/{id}',[QuestionController::class,'show'])->name('question.show');

    Route::get('/create',[QuestionController::class,'create'])->name('question.create')->middleware('auth');
    Route::post('/',[QuestionController::class,'store'])->name('question.store');

    Route::get('/{id}/edit',[QuestionController::class,'edit'])->name('question.edit');
    Route::put('/{id}',[QuestionController::class,'update'])->name('question.update');

    Route::delete('/{id}',[QuestionController::class,'destroy'])->name('question.destroy');
});

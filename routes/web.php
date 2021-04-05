<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;

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

Auth::routes(['verify' => true]);

Route::resource('question', QuestionController::class);
Route::prefix('question/{question}')->group(function () {
    Route::resource('answer', AnswerController::class, [
        'except' => ['show', 'index']
    ])->middleware('auth');
    Route::post('/answer/{answer}/approve', [AnswerController::class, 'approve'])->name('answer.approve')->middleware('auth');
    Route::put('/answer/{answer}/unapprove', [AnswerController::class, 'unapprove'])->name('answer.unapprove')->middleware('auth');
});
Route::resource('tag', TagController::class, [
    'only' => ['index', 'show', 'store', 'destroy']
]);
Route::view('/dashboard', 'dashboard')->name('dashboard');
Route::view('/', 'home')->name('home');
Route::prefix('comment')->group(function () {
    Route::get('{question}/create', [CommentController::class, 'commentQuestionCreate'])->name('commentQuestion.create');
    Route::get('answer/{answer}/create', [CommentController::class, 'commentAnswerCreate'])->name('commentAnswer.create');
    Route::post('{question}', [CommentController::class, 'commentQuestionStore'])->name('commentQuestion.store');
    Route::post('answer/{answer}', [CommentController::class, 'commentAnswerStore'])->name('commentAnswer.store');
    Route::delete('{comment}', [CommentController::class, 'destroy'])->name('comment.destroy');
});

Route::resource('user', UserController::class,[
    'except' => ['create']
]);
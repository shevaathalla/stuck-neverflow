<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PDFController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;

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

Route::get('auth/github', [AuthController::class,'redirectToProvider'])->name('login.github');
Route::get('auth/github/callback', [AuthController::class,'handleProviderCallback']);

Route::resource('question', QuestionController::class);
Route::prefix('question/{question}')->group(function () {
    Route::resource('answer', AnswerController::class, [
        'except' => ['show', 'index']
    ])->middleware('auth');
    Route::post('/answer/{answer}/approve', [AnswerController::class, 'approve'])->name('answer.approve')->middleware('auth');
    Route::put('/answer/{answer}/unapprove', [AnswerController::class, 'unapprove'])->name('answer.unapprove')->middleware('auth');
    Route::post('/generatepdf',[PDFController::class,'question'])->name('question.generatepdf');
});

Route::resource('tag', TagController::class, [
    'only' => ['index', 'store', 'destroy']
]);

Route::get('/tag/{tag}/question',[TagController::class,'question'])->name('tag.question');
Route::get('/tag/{tag}/article',[TagController::class,'article'])->name('tag.article');

Route::get('/', [HomeController::class,'index'] )->name('home');
Route::post('/searchTag',[HomeController::class,'searchTag'])->name('tag.search');


Route::prefix('comment')->group(function () {
    Route::get('{question}/create', [CommentController::class, 'commentQuestionCreate'])->name('commentQuestion.create');
    Route::get('answer/{answer}/create', [CommentController::class, 'commentAnswerCreate'])->name('commentAnswer.create');
    Route::post('{question}', [CommentController::class, 'commentQuestionStore'])->name('commentQuestion.store');
    Route::post('answer/{answer}', [CommentController::class, 'commentAnswerStore'])->name('commentAnswer.store');
    Route::delete('{comment}', [CommentController::class, 'destroy'])->name('comment.destroy');
});

Route::resource('user', UserController::class,[
        
]);
Route::resource('article',ArticleController::class);

Route::prefix('article')->group(function(){
    Route::get('{article}/comment/create',[CommentController::class,'commentArticleCreate'])->name('commentArticle.create');
    Route::post('{article}/comment',[CommentController::class,'commentArticleStore'])->name('commentArticle.store');
});

Route::get('user/{user}/article', [ArticleController::class, 'userArticle'])->name('user.article');
Route::get('user/{user}/dashboard', [UserController::class,'dashboard'])->name('dashboard');
Route::get('user/{user}/verify',[UserController::class,'verify'])->name('user.verify');
Route::get('user/{user}/notification', [NotificationController::class,'index'])->name('user.notification');
Route::get('user/{user}/notification/{notification}', [NotificationController::class,'show'])->name('notification.show');

Route::view('/test', 'pdf.question');
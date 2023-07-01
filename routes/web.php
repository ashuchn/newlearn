<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\QnaController;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\niyamController;
use App\Http\Controllers\User\TapasayaController;
use App\Http\Controllers\Admin\QuestionAnswerController;
use App\Http\Controllers\User\niyamController as UserNiyamController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;

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
Route::get('/time', function(){
    return \Carbon\Carbon::now()->toDateTimeString();
});

Route::get('sessions', function (){
    return \Session::all();
});
Route::get('contact-us',[AdminAuthController::class, 'contactUs'])->name('contact-us');
Route::get('/', [AuthController::class, 'loginView'])->name('login');
Route::middleware(['checkIfPaymentDone'])->group(function () {

Route::post('login', [AuthController::class, 'login'])->name('login.post');
Route::get('register', [AuthController::class, 'registerView'])->name('register');
Route::post('register.post', [AuthController::class, 'register'])->name('register.post');

Route::middleware(['auth'])->group(function () {
    Route::get('accounts', [AuthController::class, 'accounts'])->name('accounts');
    Route::post('account/login', [AuthController::class, 'accountLogin'])->name('account.login');
    Route::middleware(['checkAccountIsChoosen'])->group(function () {
        Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
        
        //quiz module
        Route::get('quizzes', [QnaController::class, 'index'])->name('user.quiz.index');
        Route::get('quiz/pastSubmissions', [QnaController::class, 'pastSubmissions'])->name('user.quiz.pastSubmissions');
        Route::get('quiz/today', [QnaController::class, 'todayQuiz'])->name('user.todayQuiz');
            Route::middleware(['checkQuizIsPublished'])->group(function () {
                Route::get('quiz/{id}/take', [QnaController::class, 'takeQuiz'])->name('user.takeQuiz');
                Route::post('quiz/{id}/submit', [QnaController::class, 'submitQuiz'])->name('user.submitQuiz');
            });
        Route::get('quiz/{quizId}/result/{userResponseId?}', [QnaController::class, 'quizResult'])->name('quiz.result');        

        // niyam module
        Route::get('niyam', [UserNiyamController::class,'index'])->name('user.niyam.index');
        Route::middleware(['checkNiyamSubmitted'])->group(function () {
            Route::get('niyam/quiz', [UserNiyamController::class,'quiz'])->name('user.niyam.quiz');
            Route::post('niyam/save',[UserNiyamController::class,'saveNiyam'])->name('user.saveNiyam');
        });
        Route::get('niyam/result/{submissionId}', [UserNiyamController::class,'generateResult'])->name('user.generateResult');
        Route::get('niyam/submissions', [UserNiyamController::class,'submissions'])->name('user.niyam.pastSubmission');

        // tapasaya module
        Route::get('tapasaya', [TapasayaController::class, 'index'])->name('tapasaya.index');
        Route::get('download/tapvidhi', [TapasayaController::class, 'downloadTapvidhi'])->name('download.tap_vidhi');
    });
});
Route::get('logout', [AuthController::class,'logout'])->name('logout');

/**
 * admin routes
 */

Route::group(['prefix' => 'admin'], function(){
    Route::get('login', [AdminAuthController::class,'login'])->name('admin.login');
    Route::post('login/post', [AdminAuthController::class,'loginPost'])->name('admin.loginPost');
    Route::middleware(['auth', 'checkUserRole'])->group(function () {
        Route::get('dashboard', [AdminAuthController::class, 'dashboard'])->name('admin.dashboard');

        //user module
        Route::get('users',[UserController::class, 'index'])->name('users.index');
        Route::get('user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
        Route::put('user/{id}/update', [UserController::class, 'update'])->name('user.update');

        //quiz module
        Route::get('quiz', [QuestionAnswerController::class, 'index'])->name('quiz.index');
        Route::get('quiz/{quizId}/submissions', [QuestionAnswerController::class, 'viewSubmissions'])->name('admin.quiz.viewSubmissions');
        Route::get('quiz/{quizId}/user/{userId}/result' , [QuestionAnswerController::class, 'quizResult'])->name('admin.quizResult');
        Route::get('quiz/add', [QuestionAnswerController::class, 'addQuiz'])->name('quiz.add');
        Route::post('quiz/save', [QuestionAnswerController::class, 'saveQuiz'])->name('quiz.save');
        Route::get('quiz/{quizId}/questions', [QuestionAnswerController::class, 'quizQuestions'])->name('quiz.questions');
        Route::get('quiz/{quizId}/add/question', [QuestionAnswerController::class, 'quizAddQuestions'])->name('quiz.addQuestions');
        Route::get('quiz/question/{questionId}', [QuestionAnswerController::class, 'quizQuestionDelete'])->name('quiz.questionDelete');
        Route::post('quiz/{quizId}/question/save',[QuestionAnswerController::class, 'quizSaveQuestionAnswer'])->name('quiz.saveQuestionAnswer');
        Route::post('quiz/changePublishStatus',[QuestionAnswerController::class, 'changePublishStatus'])->name('quiz.changeStatus');
        Route::get('quiz/{quizId}/generateReport',[QuestionAnswerController::class,'generateReport'])->name('quiz.generateReport');
        Route::get('quiz/generateOverallResult', [QuestionAnswerController::class, 'calculateOverallResults'])->name('admin.calculateOverallResults');

        //niyam module
        Route::get('niyam',[niyamController::class, 'index'])->name('niyam.index');
        Route::get('niyam/add',[niyamController::class, 'addNiyam'])->name('niyam.add');
        Route::post('niyam/save', [niyamController::class, 'saveNiyam'])->name('niyam.save');
        Route::get('niyam/{id}/delete', [niyamController::class, 'deleteNiyam'])->name('niyam.delete');
        Route::get('niyam/submissions', [niyamController::class, 'submissions'])->name('admin.niyamSubmissions');
        Route::get('niyam/result/{submissionId}', [niyamController::class, 'generateResult'])->name('admin.generateResult');
        Route::get('niyam/generateOverallResult', [niyamController::class, 'generateOverallResult'])->name('admin.niyam.generateResult');

        //contact us module
        Route::get('setting/contact-us', [AdminAuthController::class, 'showContactUs'])->name('admin.contactUs');
        Route::post('setting/update/contact-us', [AdminAuthController::class, 'updateContactUs'])->name('admin.contactus.update');

        
    });
    Route::get('logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
    
});
    
});
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\SettingController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\SubCategoryController;
use App\Http\Controllers\API\QuestionController;
use App\Http\Controllers\API\QuestionAnswerController;
use App\Http\Controllers\API\ExaminerController;
use App\Http\Controllers\API\AssessmentController;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['cors', 'json.response']], function () {
    Route::post('/login', [AuthController::class, 'login'])->name('login');

    Route::post('/register', [AuthController::class, 'register'])->name('register.api');
    Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.reset');
    Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::post('/checkToken', [App\Http\Controllers\Auth\AuthController::class, 'checkToken']);

    Route::post('/examiners/enroll', [ExaminerController::class, 'enroll'])->name('examiners.enroll');
    Route::get('/examiners/exam-now/{unique_key}', [ExaminerController::class, 'examNow'])->name('examiners.examNow');
    Route::post('/examiners/exam-submit', [ExaminerController::class, 'examSubmit'])->name('examiners.examSubmit');

    Route::middleware('auth:api')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout.api');

        Route::get('/settings', [SettingController::class, 'index'])->name('settings');
        Route::post('/settings', [SettingController::class, 'store'])->name('store.settings');

        // Manage Users
        Route::get('/users', [UserController::class, 'index'])->name('users.all');
        Route::post('/user/register', [UserController::class, 'store'])->name('register.user');
        Route::get('/users/{id}', [UserController::class, 'show'])->name('user.detail');
        Route::put('/users/{id}', [UserController::class, 'update'])->name('user.edit');
        Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('user.delete');

        // Manage Categories
        Route::get('/category-lists', [CategoryController::class, 'categoryList']);
        Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
        Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
        Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('categories.show');
        Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');

        // Manage SubCategories
        Route::get('/list-sub-categories/{category_id}', [SubCategoryController::class, 'listSubCategories']);
        Route::get('/sub-categories', [SubCategoryController::class, 'index'])->name('sub-categories.index');
        Route::post('/sub-categories', [SubCategoryController::class, 'store'])->name('sub-categories.store');
        Route::get('/sub-categories/{id}', [SubCategoryController::class, 'show'])->name('sub-categories.show');
        Route::put('/sub-categories/{id}', [SubCategoryController::class, 'update'])->name('sub-categories.update');
        Route::delete('/sub-categories/{id}', [SubCategoryController::class, 'destroy'])->name('sub-categories.destroy');

        // Manage Questions
        Route::get('/questions', [QuestionController::class, 'index'])->name('questions.index');
        Route::post('/questions', [QuestionController::class, 'store'])->name('questions.store');
        Route::get('/questions/{id}', [QuestionController::class, 'show'])->name('questions.show');
        Route::put('/questions/{id}', [QuestionController::class, 'update'])->name('questions.update');
        Route::delete('/questions/{id}', [QuestionController::class, 'destroy'])->name('questions.destroy');

        // Manage QuestionAnswers
        Route::get('/question-answers', [QuestionAnswerController::class, 'index'])->name('question-answers.index');
        Route::post('/question-answers', [QuestionAnswerController::class, 'store'])->name('question-answers.store');
        Route::get('/question-answers/{id}', [QuestionAnswerController::class, 'show'])->name('question-answers.show');
        Route::put('/question-answers/{id}', [QuestionAnswerController::class, 'update'])->name('question-answers.update');
        Route::delete('/question-answers/{id}', [QuestionAnswerController::class, 'destroy'])->name('question-answers.destroy');

        // Manage Examiners
        Route::get('/examiners', [ExaminerController::class, 'index'])->name('examiners.index');
        Route::post('/examiners/search', [ExaminerController::class, 'search'])->name('examiners.search');
        Route::post('/examiners', [ExaminerController::class, 'store'])->name('examiners.store');
        Route::get('/examiners/{id}', [ExaminerController::class, 'show'])->name('examiners.show');
        Route::put('/examiners/{id}', [ExaminerController::class, 'update'])->name('examiners.update');
        Route::delete('/examiners/{id}', [ExaminerController::class, 'destroy'])->name('examiners.destroy');

        // Manage Assessments
        Route::get('/assessments', [AssessmentController::class, 'index'])->name('assessments.index');
        Route::post('/assessments', [AssessmentController::class, 'store'])->name('assessments.store');
        Route::get('/assessments/{id}', [AssessmentController::class, 'show'])->name('assessments.show');
        Route::put('/assessments/{id}', [AssessmentController::class, 'update'])->name('assessments.update');
        Route::delete('/assessments/{id}', [AssessmentController::class, 'destroy'])->name('assessments.destroy');
    });
});

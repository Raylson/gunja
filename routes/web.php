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
use App\Http\Controllers\ExamController;
use App\Http\Controllers\Auth\ForgotPasswordController;

Route::get('/symlink_create', function () {
    // \Artisan::call('storage:link');
    $target = '/httpdocs/storage/app/public';
   $shortcut = '/httpdocs/public/storage';
   symlink($target, $shortcut);
});

Route::group(['middleware' => ['not-auth.user']], function () {
    Route::get('/admin/login', function () {
        return view('backend.main');
    });

    Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
    Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 
    Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
    Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

    // Route::get('/password/reset', function () {
    //     return view('backend.main');
    // });
    // Route::get('/password/reset/{token}', function () {
    //     return view('backend.main');
    // });

    Route::get('/register', function () {
        return view('backend.main');
    });

    Route::get('/login', function () {
        return redirect('/');
    });

    Route::get('/exam/enroll', function () {
        return view('backend.main');
    });
    Route::get('/exam-now/{uniqueKey}', [ExamController::class, 'exam']);
    Route::post('/submit-exam/{uniqueKey}', [ExamController::class, 'submitExam'])->name('submit.exam');
    Route::get('/exam-summary/{uniqueKey}', [ExamController::class, 'examSummary'])->name('exam.summary');
    Route::get('/assessment/export-pdf/{examiner_id}', [ExamController::class, 'exportPDFAssessment']);
});

Route::group(['middleware' => ['auth.user']], function () {
    Route::group(['middleware' => ['normal.user']], function () {
        Route::get('/admin/{any}', function () {
            return view('backend.main');
        })->where('any', '.*');
    });

    Route::group(['middleware' => ['admin.user']], function () {
        Route::get('/examiners/list', function () {
            return view('backend.main');
        })->where('any', '.*');
        Route::get('/exam-detail/{examinerId}', [ExamController::class, 'examinerDetail']);
        Route::post('/exam-update-status/{examinerId}', [ExamController::class, 'examStatusUpdate'])->name('exam.status.update');
    });

    Route::group(['middleware' => ['superadmin.user']], function () {
        Route::get('/examiners/verified/list', function () {
            return view('backend.main');
        })->where('any', '.*');
        Route::get('/exam-detail-verified/{examinerId}', [ExamController::class, 'examinerDetail']);
        Route::post('/exam-update-score/{examinerId}', [ExamController::class, 'examScoreUpdate'])->name('exam.score.update');
    });

});

Route::domain('{subdomain}.'.config('app.short_url'))->group(function () {
    Route::get('/', [App\Http\Controllers\SubdomainController::class, 'index'])->name('subdomain.index');
});

Route::get('/', function () {
    return view('backend.main');
});

Route::get('/privacy', function () {
    return view('welcome');
});
Route::get('/terms', function () {
    return view('welcome');
});

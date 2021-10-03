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

Route::group(['middleware' => ['not-auth.user']], function () {
    Route::get('/admin/login', function () {
        return view('backend.main');
    });
    Route::get('/exam/step-one', function () {
        return view('backend.main');
    });
    Route::get('/exam-now/{uniqueKey}', function () {
        return view('backend.main');
    });

    Route::get('/password/reset', function () {
        return view('backend.main');
    });
    Route::get('/password/reset/{token}', function () {
        return view('backend.main');
    });
    Route::get('/register', function () {
        return view('backend.main');
    });

    Route::get('/login', function () {
        return redirect('/admin/login');
    });
});

Route::group(['middleware' => ['auth.user']], function () {
    Route::group(['middleware' => ['normal.user']], function () {
        Route::get('/admin/{any}', function () {
            return view('backend.main');
        })->where('any', '.*');
    });

    Route::get('/examiners/{any}', function () {
        return view('backend.main');
    })->where('any', '.*');
});

Route::domain('{subdomain}.'.config('app.short_url'))->group(function () {
    Route::get('/', [App\Http\Controllers\SubdomainController::class, 'index'])->name('subdomain.index');
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/privacy', function () {
    return view('welcome');
});
Route::get('/terms', function () {
    return view('welcome');
});

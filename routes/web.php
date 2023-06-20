<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientDocumentController;
use App\Http\Controllers\ClientExamController;
use App\Http\Controllers\ClientSearchController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuestionController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
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

// Route::get('/admin', function () {
//     return view('admin/home/home');
// });




Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/login', [AuthController::class, "login"])->name('login');
    Route::post('/check', [AuthController::class, "check"])->name('check');
    Route::get('/home', [AuthController::class, "index"])->name('home');

    Route::middleware((["auth:admin"]))->group(function () {
        Route::get('/home', [AuthController::class, "index"])->name('home');
        Route::get('/logout', [AuthController::class, "login"])->name('logout');


        ////admin-category
        Route::prefix('category')->name("category.")->group(function () {
            Route::get('/index', [CategoryController::class, "index"])->name('index');
            Route::get('/create', [CategoryController::class, "create"])->name('create');
            Route::post('/store', [CategoryController::class, "store"])->name('store');
            Route::get('/show/{id}', [CategoryController::class, "show"])->name('show');
            Route::post('/edit/{id}', [CategoryController::class, "edit"])->name('edit');
            Route::delete('/delete', [CategoryController::class, "destroy"])->name('delete');
        });

        ////document-category
        Route::prefix('document')->name("document.")->group(function () {
            Route::get('/index', [DocumentController::class, "index"])->name('index');
            Route::get('/create', [DocumentController::class, "create"])->name('create');
            Route::post('/store', [DocumentController::class, "store"])->name('store');
            Route::get('/show/{id}', [DocumentController::class, "show"])->name('show');
            Route::post('/edit/{id}', [DocumentController::class, "edit"])->name('edit');
            Route::delete('/delete', [DocumentController::class, "destroy"])->name('delete');
        });


        ////exam
        Route::prefix('exam')->name("exam.")->group(function () {
            Route::get('/index', [ExamController::class, "index"])->name('index');
            Route::get('/create', [ExamController::class, "create"])->name('create');
            Route::post('/store', [ExamController::class, "store"])->name('store');
            Route::get('/show/{id}', [ExamController::class, "show"])->name('show');
            Route::post('/edit/{id}', [ExamController::class, "edit"])->name('edit');
            Route::delete('/delete', [ExamController::class, "destroy"])->name('delete');
        });


        ////question
        Route::prefix('question')->name("question.")->group(function () {
            Route::get('/index/{id}', [QuestionController::class, "index"])->name('index');
            Route::get('/create', [QuestionController::class, "create"])->name('create');
            Route::post('/store/{id}', [QuestionController::class, "store"])->name('store');
            // Route::get('/show/{id}', [QuestionController::class, "show"])->name('show');
            Route::post('/edit/{exam_id}/{question_id}', [QuestionController::class, "edit"])->name('edit');
            Route::delete('/delete', [QuestionController::class, "destroy"])->name('delete');
        });
    });
});


Route::name('client.')->group(function () {

    Route::get('/', [HomeController::class, "index"])->name('index');
    Route::get('/document/{slug}', [ClientDocumentController::class, "index"]);
    Route::get('/search', [ClientSearchController::class, "index"])->name('search');


    Route::get('/auth/redirect', function () {
        return Socialite::driver('google')->redirect();
    })->name("redirect");


    Route::middleware((["auth:web"]))->group(function () {
        Route::get(
            '/auth/logout',
            function () {

                Auth::guard('web')->logout();

                return Redirect::to("/")->with("success", "đã đăng xuất thành công");
            }
        )->name("logout");


        Route::get('/exam/show/{id}', [ClientExamController::class, "show"])->name('exam.show');



        Route::post('/exam/submit/{id}', [ClientExamController::class, "update_exam"])->name('exam.submit');
        Route::get('/exam/show_result/{id}', [ClientExamController::class, "show_result"])->name('exam.show_result');
    });


    Route::get('/exam', [ClientExamController::class, "index"])->name('exam');
});



// auth client
Route::get('riengtu', function () {
    return '<h1>rieng tu</h1>';
});
Route::get('dieukhoan', function () {
    return '<h1>rieng tu</h1>';
});


Route::get('/auth/callback', function () {
    $user = Socialite::driver('google')->user();

    // Tìm kiếm tài khoản tương ứng với email từ Google
    $existingUser = User::where('email', $user->email)->first();

    if ($existingUser) {
        // Đăng nhập tài khoản đã tồn tại

        Auth::guard('web')->login($existingUser);
    } else {
        // Tạo một tài khoản mới
        $newUser = User::create([
            'name' => $user->name,
            'email' => $user->email,
            "google_id" => $user->id,
            "avatar" => $user->avatar

        ]);

        // Đăng nhập tài khoản mới
        Auth::guard('web')->login($newUser);
    }

    return Redirect::to("/")->with("success", "đã đăng nhập thành công");
});

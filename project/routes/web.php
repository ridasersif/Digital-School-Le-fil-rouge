<?php
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\SocialiteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Middleware\CheckAuthentication;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Middleware\CheckRole;

// require __DIR__.'/Auth.php';
// Route::get('/', function () {
//     return view('layouts.dashboard');
// });

Route::get('/', function () {
    return view('frontend.home');
})->name('home');

Route::middleware([CheckAuthentication::class,'auth'])->group( function () {
    Route::post('/logout',[AuthController::class,'logout'])->name('logout');

    Route::middleware([CheckRole::class.':1'])->group(function(){
        Route::get('dashboard', function () {
            return view('admin.statistics');
        })->name('admin.index'); 
        Route::resource('categories', CategoryController::class);
    });
    
});


    






Route::get('/terms', function () {
    return view('frontend.terms'); 
})->name('terms');

Route::get('/privacy', function () {
    return view('frontend.privacy'); 
})->name('privacy');


Route::get('/register',[AuthController::class,'formRegister'])->name('register');
Route::post('/register',[AuthController::class,'register'])->name('register');

Route::get('/login',[AuthController::class,'formLogin'])->name('login');
Route::post('/login',[AuthController::class,'login'])->name('login');

Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::get('login/google', [SocialiteController::class, 'redirectToGoogle'])->name('login.google');
Route::get('login/google/callback', [SocialiteController::class, 'handleCallback']);

Route::get('select-role', [SocialiteController::class, 'showRoleSelection'])->name('select-role');
Route::post('select-role', [SocialiteController::class, 'saveRole'])->name('save-role');




<?php
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\SocialiteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Middleware\CheckAuthentication;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\CheckRole;
use App\Http\Controllers\Admin\AdminController;

// require __DIR__.'/Auth.php';
Route::get('/test', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('frontend.home');
})->name('home');




Route::middleware([CheckAuthentication::class,'auth'])->group( function () {
    Route::post('/logout',[AuthController::class,'logout'])->name('logout');
             
         //update Profil
    Route::get('/securiteProfile', function () {
        return view('profile.securiteProfile');
    })->name('securiteProfile');
    
    
    Route::get('/meProfile', function () {
        return view('profile.showProfile');
    })->name('meProfile');
    
    
    Route::get('/imageProfile', function () {
        return view('profile.imageProfile');
    })->name('imageProfile');

    Route::post('/update-email',[ProfileController::class,'updateEmail'])->name('update.email');
    Route::post('/update-password',[ProfileController::class,'updatePassword'])->name('update.password');
    Route::post('/update-profile',[ProfileController::class,'updateProfile'])->name('update.Profile');
    Route::post('/update-Avatar',[ProfileController::class,'updateAvatar'])->name('update.Avatar');
    Route::post('/delete-Avatar', [ProfileController::class, 'deleteAvatar'])->name('delete.Avatar');


    Route::middleware([CheckRole::class.':1'])->group(function(){
        Route::get('dashboard', function () {
            return view('admin.statistics');
        })->name('admin.index'); 

    

        Route::prefix('admin')->name('admin.')->group(function () {
        
            // Route to display all users
            Route::get('/users', [AdminController::class, 'showAllUsers'])->name('users.index');
            
            // Route to delete a user
            Route::delete('/users/delete/{id}', [AdminController::class, 'deleteUser'])->name('users.delete');
            
            // Route to edit a admin
            Route::get('/users/edit/{id}', [AdminController::class, 'editUser'])->name('users.edit');
            Route::post('/users/update/{id}', [AdminController::class, 'updateUser'])->name('users.update');
        });
        Route::post('/users/toggle-status', [AdminController::class, 'toggleStatus'])->name('users.toggleStatus');

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




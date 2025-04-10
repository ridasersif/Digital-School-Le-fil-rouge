<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\CoursController;
use App\Http\Controllers\ContentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Middleware\CheckAuthentication;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\CheckRole;
use App\Http\Controllers\Admin\AdminController;
use App\Models\Content;
use Illuminate\Routing\Route as RoutingRoute;

// require __DIR__.'/Auth.php';
Route::get('/test', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('frontend.home');
})->name('home');




Route::middleware([CheckAuthentication::class, 'auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

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

    Route::post('/update-email', [ProfileController::class, 'updateEmail'])->name('update.email');
    Route::post('/update-password', [ProfileController::class, 'updatePassword'])->name('update.password');
    Route::post('/update-profile', [ProfileController::class, 'updateProfile'])->name('update.Profile');
    Route::post('/update-Avatar', [ProfileController::class, 'updateAvatar'])->name('update.Avatar');
    Route::post('/delete-Avatar', [ProfileController::class, 'deleteAvatar'])->name('delete.Avatar');


    Route::middleware([CheckRole::class . ':1'])->group(function () {
       
        //route pour afficher le tableau de bord de l'administrateur
        Route::prefix('admin')->name('admin.')->group(function () {
            Route::get('dashboard', function () {
                return view('admin.statistics');
            })->name('index');
            // Route pour afficher tous les utilisateurs
            Route::get('/users', [AdminController::class, 'showAllUsers'])->name('users.index');
            // Route pour afficher tous les enseignants (asatida)
            Route::get('/instructors', [AdminController::class, 'showAllInstructors'])->name('instructors.index');
            // Route pour afficher tous les élèves (talamin)
            Route::get('/students', [AdminController::class, 'showAllStudents'])->name('students.index');
            // Route pour afficher tous les utilisateurs inactifs
            Route::get('/users/inactive', [AdminController::class, 'showInactiveUsers'])->name('users.inactive');
            // Route to delete a user
            Route::delete('/users/delete/{id}', [AdminController::class, 'deleteUser'])->name('users.delete');
             // Route to change the status of a user
            Route::post('/users/toggle-status', [AdminController::class, 'toggleStatus'])->name('users.toggleStatus');
        });
        //Route pour gérer les catégories
        Route::resource('categories', CategoryController::class);
    });
    //Route pour afficher le tableau de bord de l'instructeur
    Route::middleware([CheckRole::class . ':2'])->group(function () {
        Route::prefix('instructor')->name('instructor.')->group(function () {
            // Route pour afficher le tableau de bord de l'instructeur
            Route::get('dashboard', function () {
                return view('instructor.statistics');
            })->name('index');
            // Route pour afficher les cours de l'instructeur
            Route::resource('courses', CoursController::class);
            Route::get('contents/index', [ContentController::class, 'index'])->name('contents.index');
            Route::get('contents/create', [ContentController::class, 'create'])->name('contents.create');
            Route::get('contents/review', [ContentController::class, 'review'])->name('contents.review');

        });
    });
});






Route::get('/terms', function () {
    return view('frontend.terms');
})->name('terms');

Route::get('/privacy', function () {
    return view('frontend.privacy');
})->name('privacy');


Route::get('/register', [AuthController::class, 'formRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/login', [AuthController::class, 'formLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::get('login/google', [SocialiteController::class, 'redirectToGoogle'])->name('login.google');
Route::get('login/google/callback', [SocialiteController::class, 'handleCallback']);

Route::get('select-role', [SocialiteController::class, 'showRoleSelection'])->name('select-role');
Route::post('select-role', [SocialiteController::class, 'saveRole'])->name('save-role');

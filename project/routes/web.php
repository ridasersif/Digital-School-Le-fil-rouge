<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\CoursController;
use App\Http\Controllers\ContentController;
use App\Http\Middleware\CheckRoleUser;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Middleware\CheckAuthentication;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\CheckRole;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\AvisController;
use App\Http\Controllers\CertificatController;
use App\Http\Controllers\FormateurController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PanierController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\StatistiqueController;
use App\Http\Controllers\StudentController;
use App\Http\Middleware\CheckStatus;
use App\Http\Middleware\CheckAdminOrInstructor;
use App\Models\Content;
use Illuminate\Routing\Route as RoutingRoute;

// require __DIR__.'/Auth.php';
Route::get('/test', function () {
    return view('welcome');
});




Route::post('/cours/{cours}/avis', [AvisController::class, 'store'])->name('avis.store');

Route::middleware([CheckRoleUser::class])->group(function () {
    Route::get('/', [HomeController::class, 'showHomePageData'])->name('home');
    Route::get('/touteCourses', [HomeController::class, 'getAllCourses'])->name('home.getAllCourses');
    Route::get('/courses/{id}', [HomeController::class, 'show'])->name('courses.show');






    Route::post('/panier/ajouter/{cours}', [PanierController::class, 'ajouter'])->name('panier.ajouter');

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



        Route::middleware([CheckAdminOrInstructor::class,])->group(function () {

            Route::get('/course/{status}', [CoursController::class, 'index'])
                ->whereIn('status', ['all', 'draft', 'pending', 'published'])
                ->name('course.byStatus');

            Route::get('/course', function () {
                return redirect()->route('course.byStatus', ['status' => 'all']);
            })->name('course.index');

            Route::post('/course/update-status/{id}', [CoursController::class, 'updateStatus'])
                ->name('course.updateStatus');
            Route::get('/course/{course}', [CoursController::class, 'show'])->name('course.show');
        });




        Route::middleware([CheckRole::class . ':1'])->group(function () {

            //route pour afficher le tableau de bord de l'administrateur
            Route::prefix('admin')->name('admin.')->group(function () {
               
                Route::get('dashboard',[StatistiqueController::class,'statistiqueForadmin'])->name('statistiqueForadmin');
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
                // Route to show all reviews
                Route::get('avis',[AdminController::class,'gatAllAvis'])-> name('avis');
                // Route to delete a review
                Route::delete('/avis/delete/{id}', [AvisController::class, 'delete'])->name('avis.destroy');

                Route::get('/payments', [PaymentController::class, 'getAllPaymentsForAdmin'])->name('payments');
            });
            //Route pour gérer les catégories
            Route::resource('categories', CategoryController::class);
        });

        //Route pour afficher le tableau de bord de l'instructeur
        Route::middleware([CheckRole::class . ':2', CheckStatus::class])->group(function () {
            Route::prefix('instructor')->name('instructor.')->group(function () {
                // Route pour afficher le tableau de bord de l'instructeur
                Route::get('dashboard',[StatistiqueController::class,'statistiqueForInstructor'])->name('statistiqueForInstructor');


                Route::resource('course', CoursController::class)->except(['index', 'show']);

                Route::get('/content/create/{cours_id}', [ContentController::class, 'create'])->name('content.create');
                Route::post('/content', [ContentController::class, 'store'])->name('content.store');
                Route::delete('/contents/{content}', [ContentController::class, 'destroy'])->name('contents.destroy');
                Route::get('/contents/{content}', [ContentController::class, 'edit'])->name('contents.edit');
                Route::put('/contents/{content}', [ContentController::class, 'update'])->name('contents.update');

                Route::get('contents/create', [ContentController::class, 'create'])->name('contents.create');
                Route::get('contents/review', [ContentController::class, 'review'])->name('contents.review');
                //Route pour les Avis de foprmateur
                Route::get('mesAvis',[FormateurController::class,'mesAvis'])-> name('mesAvis');

               
                Route::get('/payments', [PaymentController::class, 'getPaymentsForFormateur'])->name('payments');

                Route::get('etudiantsInscrits',[FormateurController::class,'etudiantsInscrits'])->name('etudiantsInscrits');

            });
        });
        //Route pour les etudiant 
        Route::middleware([CheckRole::class . ':3', CheckStatus::class])->group(function () {


            Route::get('/payer-maintenant', [PaymentController::class, 'showPaymentPage'])->name('payment.page');
            Route::get('/payment-intent', [PaymentController::class, 'createPaymentIntent'])->name('payment.intent');
            Route::get('/payment/success', [PaymentController::class, 'success'])->name('payment.success');
            Route::get('/payment/cancel', [PaymentController::class, 'cancel'])->name('payment.cancel');
            Route::get('/payment/get-courses', [PaymentController::class, 'getCourses'])->name('payment.get.courses');
            Route::get('/certificat/{cours}/download', [CertificatController::class, 'download'])->name('certificat.download');

            Route::post('/contents/{id}/viewed', [ContentController::class, 'markAsViewed'])
                ->middleware('auth')
                ->name('contents.viewed');

            Route::get('/checkout', [PaymentController::class, 'checkout'])->name('checkout');
            Route::get('/success', [PaymentController::class, 'success'])->name('payment.success');
            Route::get('/cancel', [PaymentController::class, 'cancel'])->name('payment.cancel');
            Route::prefix('student')->name('student.')->group(function () {
                Route::post('/panier/ajouter/{cours}', [PanierController::class, 'ajouter'])->name('panier.ajouter');
                Route::get('/panier/afficher', [PanierController::class, 'afficherPanier'])->name('panier.afficher');
                Route::delete('/panier/delete/{cours}', [PanierController::class, 'delete'])->name('panier.delete');
                Route::delete('/panier/vider', [PanierController::class, 'vider'])->name('panier.vider');
                //route poue le paiement
                Route::post('/paiement/valider', [PaymentController::class, 'validerPaiement'])->name('paiement.valider');
                Route::get('my-courses', [StudentController::class, 'index'])->name('myCourses');
                Route::get('my-courses/{id}', [StudentController::class, 'show'])->name('myCourses.show');
            });
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

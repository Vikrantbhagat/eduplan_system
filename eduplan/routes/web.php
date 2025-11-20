<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\Instructor\CourseController as InstructorCourseController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CourseApprovalController as AdminCourseApprovalController;
use App\Http\Controllers\Instructor\InstructorDashboardController;
use App\Http\Controllers\CourseFilterController; 
use App\Http\Controllers\TeamController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\StudentAuthController;
use App\Http\Controllers\MyCoursesController;
use App\Http\Controllers\CourseDetailsController;
use App\Http\Controllers\InstructorPurchasedController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\InstructorFeedbackController;
use App\Http\Controllers\AdminAnalyticsController;


// ======================================================
// 🔥 NEW UPDATED REQUIREMENT: ROOT → STUDENT LOGIN PAGE
// ======================================================
Route::get('/', function () {
    return redirect()->route('student.login');
});


// ======================================================
// ADMIN ROUTES
// ======================================================
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'role:admin'])
    ->group(function () {

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::get('/analytics', [AdminDashboardController::class, 'analytics'])->name('analytics');
    });

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/purchases', [PurchaseController::class, 'index'])->name('admin.purchases');
});


// Instructor Feedback
Route::middleware(['auth', 'role:instructor'])->group(function () {
    Route::get('/instructor/feedbacks', [InstructorFeedbackController::class, 'index'])->name('instructor.feedbacks');
    Route::delete('/instructor/feedbacks/{id}', [InstructorFeedbackController::class, 'destroy'])->name('instructor.feedbacks.destroy');
});

Route::post('/courses/{course}/feedback', [FeedbackController::class, 'store'])->name('feedback.store');
Route::delete('/feedback/{id}', [FeedbackController::class, 'destroy'])->name('feedback.destroy');

Route::delete('/purchases/{course}', [PurchaseController::class, 'destroy'])
    ->name('purchases.destroy')
    ->middleware('auth');

Route::middleware(['auth'])->prefix('instructor')->name('instructor.')->group(function () {
    Route::get('/purchased-courses', [InstructorPurchasedController::class, 'index'])->name('purchased.index');
});

Route::get('/course-details/{id}', [CourseDetailsController::class, 'show'])->name('course.details.show');

Route::middleware(['auth'])->group(function () {
    Route::get('/my-courses', [MyCoursesController::class, 'index'])->name('my.courses');
});


// COURSES & DETAILS
Route::get('/courses/{id}', [InstructorCourseController::class, 'show'])->name('courses.details');
Route::get('/course/{id}', [CourseFilterController::class, 'show'])->name('courses.show');
Route::get('/all-course', [InstructorController::class, 'allCourses'])->name('courses.all');


// CART & CHECKOUT
Route::middleware(['auth', 'web'])->group(function () {

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

    Route::prefix('cart')->group(function () {
        Route::get('/view', [CartController::class, 'viewCart'])->name('cart.view');
        Route::post('/add/{courseId}', [CartController::class, 'addToCart'])->name('cart.add');
        Route::delete('/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    });

    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::get('/checkout/buy-now/{course}', [CheckoutController::class, 'buyNow'])->name('checkout.buyNow');
    Route::post('/checkout/complete', [CheckoutController::class, 'complete'])->name('checkout.complete');
    Route::post('/checkout/create-payment-intent', [CheckoutController::class, 'createPaymentIntent'])->name('checkout.createPaymentIntent');

    Route::get('/checkout/{course}', [CheckoutController::class, 'indexSingle'])->name('checkout.single');
    Route::get('/orders/{order}', [CheckoutController::class, 'show'])->name('orders.show');
});


// STATIC PAGES
Route::get('/contact-us', [ContactController::class, 'showForm'])->name('contact.form');
Route::post('/contact-us', [ContactController::class, 'sendMail'])->name('contact.send');
Route::get('/our-team', [TeamController::class, 'index'])->name('our-team');

Route::get('/student/dashboard', function () {
    return view('dashboards.student.dashboard');
})->name('student.dashboard');

Route::view('/about-us', 'pages.about-us')->name('about');
Route::view('/services-details', 'pages.services-details');
Route::view('/instructors', 'pages.instructors');
Route::view('/about-instructor', 'pages.about-instructor');
Route::view('/country-details', 'pages.country-details');
Route::view('/all-course-widget', 'pages.all-course-widget');
Route::view('/apply-online', 'pages.apply-online');
Route::view('/shop-cart', 'pages.shop-cart');
Route::view('/faq', 'pages.faq');
Route::view('/cart-empty', 'pages.cart-empty');
Route::view('/blog', 'pages.blog');
Route::view('/blog-classic', 'pages.blog-classic');
Route::view('/blog-details', 'pages.blog-details');


// INSTRUCTORS
Route::get('/instructors', [InstructorController::class, 'index'])->name('instructors.index');
Route::get('/instructors/{id}', [InstructorController::class, 'show'])->name('instructors.show');


// AUTH - GUEST
Route::middleware('guest')->group(function () {
    Route::get('student/register', [StudentAuthController::class, 'showRegister'])->name('student.register');
    Route::post('student/register', [StudentAuthController::class, 'register'])->name('student.register.submit');

    Route::get('student/login', [StudentAuthController::class, 'showLogin'])->name('student.login');
    Route::post('student/login', [StudentAuthController::class, 'login'])->name('student.login.submit');
});


// AUTH - STUDENT
Route::middleware(['auth', 'student'])->group(function () {
    Route::get('student/dashboard', fn() => view('dashboards.student.dashboard'))->name('student.dashboard');

    // Logout → MUST redirect to login
    Route::post('student/logout', [StudentAuthController::class, 'logout'])->name('student.logout');
});


// ADMIN DASHBOARD & MANAGEMENT
Route::prefix('admin')->name('admin.')->middleware(['auth','role:admin'])->group(function () {

    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('users.index');

    Route::delete('/users/{id}', [AdminDashboardController::class, 'destroyUser'])->name('users.destroy');
    Route::get('/users/{id}/edit', [AdminDashboardController::class, 'editUser'])->name('users.edit');
    Route::put('/users/{id}', [AdminDashboardController::class, 'updateUser'])->name('users.update');
    Route::get('/users/{id}/courses', [AdminDashboardController::class, 'viewCourses'])->name('users.courses');

    Route::get('/courses/{id}/edit', [AdminDashboardController::class, 'editCourse'])->name('courses.edit');
    Route::put('/courses/{id}', [AdminDashboardController::class, 'updateCourse'])->name('courses.update');
    Route::delete('/courses/{id}', [AdminDashboardController::class, 'destroyCourse'])->name('courses.destroy');

    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{id}/approve', [NotificationController::class, 'approve'])->name('notifications.approve');
    Route::post('/notifications/{id}/reject', [NotificationController::class, 'reject'])->name('notifications.reject');
    Route::post('/notifications/{id}/delete', [NotificationController::class, 'delete'])->name('notifications.delete');

    Route::get('/courses/pending', [AdminCourseApprovalController::class,'index'])->name('courses.pending');
    Route::get('/courses/{id}', [AdminCourseApprovalController::class,'show'])->name('courses.show');
    Route::post('/courses/{id}/approve', [AdminCourseApprovalController::class,'approve'])->name('courses.approve');
    Route::post('/courses/{id}/reject', [AdminCourseApprovalController::class,'reject'])->name('courses.reject');
});


// INSTRUCTOR DASHBOARD & COURSES
Route::middleware(['auth'])->prefix('instructor')->name('instructor.')->group(function () {
    Route::get('/dashboard', fn() => view('instructor.dashboard', [
        'user' => Auth::user(),
        'courses' => Auth::user()->courses()->latest()->get()
    ]))->name('dashboard');

    Route::get('/courses', [InstructorCourseController::class, 'index'])->name('courses.index');
    Route::get('/courses/create', [InstructorCourseController::class, 'create'])->name('courses.create');
    Route::post('/courses', [InstructorCourseController::class, 'store'])->name('courses.store');
    Route::get('/courses/{id}', [InstructorCourseController::class, 'show'])->name('courses.show');
    Route::get('/courses/{id}/edit', [InstructorCourseController::class, 'edit'])->name('courses.edit');
    Route::put('/courses/{id}', [InstructorCourseController::class, 'update'])->name('courses.update');
    Route::delete('/courses/{id}', [InstructorCourseController::class, 'destroy'])->name('courses.destroy');
});


// DASHBOARD
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});


// PROFILE
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});

// GENERAL AUTH
Route::get('/login/{role}', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login/{role}', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// REGISTRATION
Route::get('/register/admin', [RegisterController::class, 'showAdminRegisterForm'])->name('register.admin.form');
Route::post('/register/admin', [RegisterController::class, 'registerAdmin'])->name('register.admin.submit');

Route::get('/register/instructor', [RegisterController::class, 'showInstructorRegisterForm'])->name('register.instructor.form');
Route::post('/register/instructor', [RegisterController::class, 'registerInstructor'])->name('register.instructor.submit');


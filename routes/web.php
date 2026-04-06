<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\Admin\FinanceController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\TableScheduleController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Child\SurpriseController;
use App\Http\Controllers\Guardian\AbsenceController;
use App\Http\Controllers\Guardian\ChildController;
use App\Http\Controllers\Guardian\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Teacher\LevelController;
use App\Http\Controllers\Teacher\TeacherDashboardController;
use App\Http\Controllers\Teacher\TeacherReportController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/contactus', function () {
    return view('contactus');
})->name('contactus');

Route::get('/dashboard', function () {
    $dashboardRoute = auth()->user()->dashboardRoute();

    if ($dashboardRoute === 'dashboard') {
        return view('dashboard');
    }

    return redirect()->route($dashboardRoute);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// admin routes
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'role:admin']], function () {
    Route::get('/absense', [AttendanceController::class, 'index'])->name('admin.absense');
    Route::post('/absense', [AttendanceController::class, 'store'])->name('admin.absense.store');
    Route::patch('/absense/{attendance}', [AttendanceController::class, 'update'])->name('admin.absense.update');
    Route::view('/academicactivities', 'admin.academicactivities')->name('admin.academicactivities');
    Route::get('/admindashboard', [AdminDashboardController::class, 'index'])->name('admin.admindashboard');
    Route::get('/payment', [FinanceController::class, 'index'])->name('admin.payment');
    Route::post('/payment', [FinanceController::class, 'store'])->name('admin.payment.store');
    Route::delete('/payment/{payment}', [FinanceController::class, 'destroy'])->name('admin.payment.destroy');
    Route::get('/reports', [ReportController::class, 'index'])->name('admin.reports');
    Route::get('/settings', [SettingsController::class, 'edit'])->name('admin.settings');
    Route::patch('/settings', [SettingsController::class, 'update'])->name('admin.settings.update');
    Route::get('tables', [TableScheduleController::class, 'index'])->name('admin.tables');
    Route::get('/users', [UserManagementController::class, 'index'])->name('admin.users');
    Route::patch('/users/{user}', [UserManagementController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{user}', [UserManagementController::class, 'destroy'])->name('admin.users.destroy');
});
// Child routes
Route::group(['prefix' => 'child', 'middleware' => ['auth', 'role:child']], function () {
    Route::view('/activties', 'child.activties')->name('child.activties');
    Route::view('/attendance', 'child.attendance')->name('child.attendance');
    Route::view('/home', 'child.home')->name('child.home');
    Route::get('/surprise', [SurpriseController::class, 'index'])->name('child.surprise');
    Route::view('/teachertalk', 'child.teachertalk')->name('child.teachertalk');
});

// parent routes
Route::group(['prefix' => 'parent', 'middleware' => ['auth', 'role:guardian']], function () {
    Route::get('/absence', [AbsenceController::class, 'index'])->name('parent.absence');
    Route::view('/activities', 'parent.activities')->name('parent.activities');
    Route::view('/calendar', 'parent.calendar')->name('parent.calendar');
    Route::view('/payment', 'parent.payment')->name('parent.payment');
    Route::post('/payment', [PaymentController::class, 'store'])->name('parent.payment.store');
    Route::view('/addchild', 'parent.addchild')->name('parent.addchild');
    Route::post('/addchild', [ChildController::class, 'store'])->name('parent.addchild.store');
    Route::view('/messages', 'parent.messages')->name('parent.messages');
    Route::view('/notification', 'parent.notification')->name('parent.notification');
    Route::view('/parentdashboard', 'parent.parentdashboard')->name('parent.parentdashboard');
    Route::view('/settings', 'parent.settings')->name('parent.settings');
});

// teacher routes
Route::group(['prefix' => 'teacher', 'middleware' => ['auth', 'role:teacher']], function () {
    Route::resource('levels', LevelController::class)
        ->except(['create'])
        ->names('teacher.levels');
    Route::view('/messages', 'teacher.messages')->name('teacher.messages');
    Route::get('/reports', [TeacherReportController::class, 'index'])->name('teacher.reports');
    Route::post('/reports', [TeacherReportController::class, 'store'])->name('teacher.reports.store');
    Route::get('/teacherdashboard', [TeacherDashboardController::class, 'index'])->name('teacher.teacherdashboard');
    Route::post('/teacherdashboard/attendance', [TeacherDashboardController::class, 'storeAttendance'])->name('teacher.attendance.store');
    Route::post('/teacherdashboard/activities', [TeacherDashboardController::class, 'storeActivity'])->name('teacher.activities.store');
    Route::patch('/teacherdashboard/profile', [TeacherDashboardController::class, 'updateProfile'])->name('teacher.profile.update');
});

require __DIR__.'/auth.php';

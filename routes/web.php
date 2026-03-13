<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Teacher\LevelController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/contactus', function () {
    return view('contactus');
});

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
    Route::view('/absense', 'admin.absense')->name('admin.absense');
    Route::view('/academicactivities', 'admin.academicactivities')->name('admin.academicactivities');
    Route::view('/admindashboard', 'admin.admindashboard')->name('admin.admindashboard');
    Route::view('/payment', 'admin.payment')->name('admin.payment');
    Route::view('/reports', 'admin.reports')->name('admin.reports');
    Route::view('tables', 'admin.tables')->name('admin.tables');
    Route::view('/users', 'admin.users')->name('admin.users');
});
// Child routes
Route::group(['prefix' => 'child', 'middleware' => ['auth', 'role:child']], function () {
    Route::view('/activties', 'child.activties')->name('child.activties');
    Route::view('/attendance', 'child.attendance')->name('child.attendance');
    Route::view('/home', 'child.home')->name('child.home');
    Route::view('/surprise', 'child.surprise')->name('child.surprise');
    Route::view('/teachertalk', 'child.teachertalk')->name('child.teachertalk');
});

// parent routes
Route::group(['prefix' => 'parent', 'middleware' => ['auth', 'role:guardian']], function () {
    Route::view('/absence', 'parent.absence')->name('parent.absence');
    Route::view('/activities', 'parent.activities')->name('parent.activities');
    Route::view('/payment', 'parent.payment')->name('parent.payment');
    Route::view('/addchild', 'parent.addchild')->name('parent.addchild');
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
    Route::view('/reports', 'teacher.reports')->name('teacher.reports');
    Route::view('/teacherdashboard', 'teacher.teacherdashboard')->name('teacher.teacherdashboard');
});

require __DIR__.'/auth.php';

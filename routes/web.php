<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/dashboard');
    }
    return redirect('/login');
});

Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::resource('students', \App\Http\Controllers\StudentController::class)->except(['create', 'show', 'edit'])->names([
        'index' => 'student-list',
    ]);
    
    Route::get('/attendance', [\App\Http\Controllers\AttendanceController::class, 'index'])->name('add-attendance');
    Route::post('/attendance', [\App\Http\Controllers\AttendanceController::class, 'store'])->name('attendance.store');
    
    Route::get('/reports/pdf', [\App\Http\Controllers\ReportController::class, 'pdf'])->name('reports.pdf');
    
    Route::get('/reports', [\App\Http\Controllers\ReportController::class, 'index'])->name('reports');



    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

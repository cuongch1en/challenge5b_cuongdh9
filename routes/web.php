<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\ChallengeController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    
    Route::get('/user/dashboard', [UserController::class, 'index'])->name('user.dashboard');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');

});

Route::middleware(['auth'])->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});

Route::middleware('auth')->group(function () {
    Route::patch('/profile', [ProfileController::class, 'updateProfile'])->name('profile.update');
    // Route::put('/password/update', [ProfileController::class, 'updatePassword'])->name('password.update');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/password/change', function () {
        return view('profile.partials.update-password-form');
    })->name('password.change');

    Route::put('/password/update', [ProfileController::class, 'updatePassword'])->name('password.update');
    
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard/users', [UserController::class, 'index'])->name('users.index');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::patch('/dashboard/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/dashboard/users/{id}', [UserController::class, 'destroy'])->name('users.delete');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/messages/create', [MessageController::class, 'create'])->name('messages.create');
    Route::post('/messages', [MessageController::class, 'store'])->name('messages.store');
    Route::get('/messages/inbox', [MessageController::class, 'inbox'])->name('messages.inbox');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/assignments', [AssignmentController::class, 'index'])->name('assignments.index');
    Route::get('/assignments/{assignment}/download', [AssignmentController::class, 'download'])->name('assignments.download');

    // Chỉ Admin
    Route::middleware(['admin'])->group(function () {
        Route::get('/assignments/create', [AssignmentController::class, 'create'])->name('assignments.create');
        Route::post('/assignments', [AssignmentController::class, 'store'])->name('assignments.store');
        Route::get('/assignments/{assignment}/submissions', [SubmissionController::class, 'index'])->name('submissions.index');
    });

    // User nộp bài
    Route::get('/assignments/{assignment}/submit', [SubmissionController::class, 'create'])->name('submissions.create');
    Route::post('/assignments/{assignment}/submit', [SubmissionController::class, 'store'])->name('submissions.store');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/challenges', [ChallengeController::class, 'index'])->name('challenges.index');
    Route::post('/challenges', [ChallengeController::class, 'store'])->name('challenges.store')->middleware('admin'); 
    Route::post('/challenges/{challenge}/check', [ChallengeController::class, 'checkAnswer'])->name('challenges.check');
});

require __DIR__.'/auth.php';

<?php

use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
    Route::post('/register', [AuthController::class, 'register'])->name('register');

    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::patch('/notifications/{id}/read', function ($id) {
    $notification = auth()->user()->notifications()->where('id', $id)->first();
    if ($notification) {
        $notification->markAsRead();
    }
    return back();
})->name('notifications.read');

Route::get('/', function () {
    $user = Auth::user();

    if (!$user) {
        return redirect()->route('register.form');
    }

    return match ($user->role) {
        'student' => redirect()->route('student.dashboard'),
        'teacher' => redirect()->route('teacher.dashboard'),
        default => abort(403, 'Неизвестная роль')
    };
})->middleware('auth');

Route::middleware(['auth'])->group(function () {
    Route::get('/notifications/history', [NotificationController::class, 'history'])->name('notifications.history');
});

Route::middleware(['auth', 'role:student'])->prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', [StudentDashboardController::class, 'index'])->name('dashboard');
    Route::get('/lessons/{lesson}', [StudentDashboardController::class, 'showLesson'])->name('lessons.show');

    Route::post('/assignments/{assignment}/submit', [StudentDashboardController::class, 'submitAssignment'])->name('assignments.submit');
    Route::post('/submissions/{submission}/comment', [StudentDashboardController::class, 'addComment'])->name('submissions.comment');

    // ✅ ТЕСТ (показ/отправка)
    Route::get('/test/{lesson_id}', [TestController::class, 'showTest'])->name('test.show');
    Route::post('/test/{id}/submit', [TestController::class, 'submit'])->name('test.submit');

    // ✅ AI: ЧАТ по уроку (используется и на уроке, и на странице теста)
    Route::post('/lessons/{lesson}/ai-chat', [StudentDashboardController::class, 'aiChat'])->name('ai.chat');

    // ✅ AI: Объяснить ошибку (кнопка "ИИ түсіндірме" в результате теста)
    Route::post('/test/{test}/ai-explain', [TestController::class, 'aiExplain'])->name('test.ai_explain');
});

Route::middleware(['auth', 'role:teacher'])->prefix('teacher')->name('teacher.')->group(function () {
    Route::post('/lessons', [LessonController::class, 'store'])->name('lessons.store');

    Route::get('/submissions/{submission}', [TeacherController::class, 'viewSubmission'])->name('submission.view');
    Route::post('/submissions/{submission}', [TeacherController::class, 'updateSubmission'])->name('submission.update');

    Route::get('/journal', [JournalController::class, 'index'])->name('journal.index');
    Route::get('/', [TeacherController::class, 'dashboard'])->name('dashboard');

    Route::get('/lessons/create', [LessonController::class, 'create'])->name('lessons.create');
    Route::delete('/lessons/{lesson}', [LessonController::class, 'destroy'])->name('lessons.destroy');

    Route::post('/lessons/{lesson}/test', [TestController::class, 'storeTest'])->name('teacher.lessons.test.store');

    Route::get('/lessons/{lesson}/assignments/create', [LessonController::class, 'createAssignment'])->name('assignments.create');
    Route::post('/lessons/{lesson}/assignments', [LessonController::class, 'storeAssignment'])->name('assignments.store');
    Route::post('/assignments/store', [AssignmentController::class, 'store'])->name('assignments.store');
});

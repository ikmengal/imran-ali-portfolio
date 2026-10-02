<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\EducationController;
use App\Http\Controllers\Admin\ExperienceController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PortfolioController;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', [PortfolioController::class, 'index'])->name('portfolio');

require __DIR__.'/auth.php';

Route::get('/{slug}', [PortfolioController::class, 'index'])->name('portfolio.user');
    Route::get('/{slug}/project/{project:slug}', [PortfolioController::class, 'showProject'])->name('portfolio.project.show');
    Route::get('/{slug}/page/{page:slug}', [PortfolioController::class, 'showPage'])->name('portfolio.page.show');

Route::post('/contact', function (Request $request) {
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'subject' => 'nullable|string|max:255',
        'message' => 'required|string',
    ]);

    ContactMessage::create($validated);

    return response()->json([
        'message' => 'Thank you for your message! I\'ll get back to you soon.',
    ]);
})->name('contact.store');

Route::middleware(['auth', 'verified.or.superadmin', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
    Route::get('/profile/messages', [ProfileController::class, 'messages'])->name('profile.messages');

    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');

    Route::resource('projects', ProjectController::class);
    Route::post('projects/{project}/toggle-status', [ProjectController::class, 'toggleStatus'])->name('projects.toggle-status');

    Route::resource('experiences', ExperienceController::class);
    Route::post('experiences/{experience}/toggle-status', [ExperienceController::class, 'toggleStatus'])->name('experiences.toggle-status');

    Route::resource('education', EducationController::class)->parameters(['education' => 'education']);
    Route::post('education/{education}/toggle-status', [EducationController::class, 'toggleStatus'])->name('education.toggle-status');

    Route::resource('skills', SkillController::class);
    Route::post('skills/{skill}/toggle-status', [SkillController::class, 'toggleStatus'])->name('skills.toggle-status');

    Route::resource('services', ServiceController::class);
    Route::post('services/{service}/toggle-status', [ServiceController::class, 'toggleStatus'])->name('services.toggle-status');

    Route::resource('testimonials', TestimonialController::class);
    Route::post('testimonials/{testimonial}/toggle-status', [TestimonialController::class, 'toggleStatus'])->name('testimonials.toggle-status');

    Route::resource('pages', PageController::class);

    Route::resource('roles', RoleController::class);
    Route::post('roles/bulk-permissions', [RoleController::class, 'bulkPermissions'])->name('roles.bulk-permissions');

    Route::resource('permissions', PermissionController::class);

    Route::resource('messages', ContactMessageController::class)->only(['index', 'show', 'edit', 'update', 'destroy']);
    Route::post('messages/{message}/read', [ContactMessageController::class, 'markAsRead'])->name('messages.read');
    Route::post('messages/{message}/unread', [ContactMessageController::class, 'markAsUnread'])->name('messages.unread');
    Route::post('messages/{message}/toggle-read', [ContactMessageController::class, 'toggleRead'])->name('messages.toggle-read');

    Route::resource('users', UserController::class);
    Route::get('users/trashed', [UserController::class, 'trashed'])->name('users.trashed');
    Route::post('users/{user}/generate-password', [UserController::class, 'generatePassword'])->name('users.generate-password');
    Route::patch('users/{user}/restore', [UserController::class, 'restore'])->withTrashed()->name('users.restore');
    Route::delete('users/{user}/force-delete', [UserController::class, 'forceDelete'])->withTrashed()->name('users.force-delete');
    Route::patch('users/{user}/password', [UserController::class, 'changePassword'])->name('users.password');
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\CompletedActivitiesController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\StaticPageController;

// Home page
Route::get('/', [HomeController::class, 'index'])->name('home');

// Articles
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{slug}', [ArticleController::class, 'show'])->name('articles.show');

// Activities
Route::get('/activities', [ActivityController::class, 'index'])->name('activities.index');
// Completed activities (activités réalisées) - must be before slug route
Route::get('/activities/completed', [CompletedActivitiesController::class, 'index'])->name('activities.completed');
Route::get('/activities/{slug}', [ActivityController::class, 'show'])->name('activities.show');

// Members
Route::get('/members', [MemberController::class, 'index'])->name('members.index');

// Search
Route::get('/search', [SearchController::class, 'index'])->name('search');

// Newsletter
Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');
Route::post('/newsletter/unsubscribe', [NewsletterController::class, 'unsubscribe'])->name('newsletter.unsubscribe');

// Contact
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Static pages
Route::get('/about', [StaticPageController::class, 'about'])->name('about');
Route::get('/{slug}', [StaticPageController::class, 'show'])->name('pages.show');

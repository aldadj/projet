<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\QsnController;
use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite; // Nécessaire si on met la logique dans le controller ou closure

/*
|--------------------------------------------------------------------------
| ROUTES PUBLIQUES (Accessibles par tous)
|--------------------------------------------------------------------------
*/

Route::get('/', [ArticleController::class, 'index'])->name('home');
Route::get('/article/{slug}', [ArticleController::class, 'show'])->name('article.show');
Route::get('/categorie/{slug}', [ArticleController::class, 'category'])->name('category.show');

// Page Contact
Route::get('/contact', [ContactController::class, 'view_contact'])->name('contact');

// L'envoi de message nécessite d'être connecté
Route::post('/contact', [ContactController::class, 'store_contact'])->name('contact.store')->middleware('auth');

// Page Qui Sommes-Nous
Route::get('/qui-sommes-nous', [QsnController::class, 'view_qsn'])->name('qsn');

/*
|--------------------------------------------------------------------------
| ROUTES D'AUTHENTIFICATION
|--------------------------------------------------------------------------
*/

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Inscription
Route::get('/register', [LoginController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [LoginController::class, 'register'])->name('register.post');

// Google Auth
Route::get('/auth/google', [LoginController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [LoginController::class, 'handleGoogleCallback'])->name('auth.google.callback');

// Likes (Nécessite d'être connecté)
Route::post('/article/{id}/like', [LikeController::class, 'toggle'])->name('article.like')->middleware('auth');

// Profil Utilisateur (Nécessite d'être connecté)
Route::get('/compte', [ProfileController::class, 'show'])->name('profile.show')->middleware('auth');
Route::put('/compte', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth');

/*
|--------------------------------------------------------------------------
| ROUTES ADMINISTRATION (Protégées par login)
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Articles
    Route::get('/article/create', [AdminController::class, 'createArticle'])->name('article.create');
    Route::post('/article/store', [AdminController::class, 'storeArticle'])->name('article.store');
    Route::get('/article/{id}/edit', [AdminController::class, 'editArticle'])->name('article.edit');
    Route::post('/article/{id}/update', [AdminController::class, 'updateArticle'])->name('article.update');
    Route::delete('/article/{id}', [AdminController::class, 'deleteArticle'])->name('article.delete');
    
    // QSN
    Route::get('/qsn', [AdminController::class, 'editQsn'])->name('qsn.edit');
    Route::post('/qsn', [AdminController::class, 'updateQsn'])->name('qsn.update');
    
    // Messages
    Route::get('/message/{id}', [AdminController::class, 'showMessage'])->name('message.show');
    Route::delete('/message/{id}', [AdminController::class, 'deleteMessage'])->name('message.delete');
});
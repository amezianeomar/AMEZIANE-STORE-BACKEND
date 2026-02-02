<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;

// Route Accueil
// Auth Routes (Login, Register, Reset)
Auth::routes();

// Default Home (Redirects here after login)
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Routes ADMIN (GOD MODE) - Protected by 'auth' and 'adminuser' middleware
Route::middleware(['auth', 'adminuser'])->group(function () {
    Route::get('/admin/dashboard', [ProductController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/admin/products', [ProductController::class, 'adminIndex'])->name('admin.products');
    
    // CRUD Operations for Admin
    Route::get('/produits/create', [ProductController::class, 'create'])->name('produits.create');
    Route::post('/produits', [ProductController::class, 'store'])->name('produits.store');
    Route::get('/produits/{id}/edit', [ProductController::class, 'edit'])->name('produits.edit');
    Route::put('/produits/{id}', [ProductController::class, 'update'])->name('produits.update');
    Route::delete('/produits/{id}', [ProductController::class, 'destroy'])->name('produits.destroy');
});

// Protected Routes (Logged In Users "Angels")
Route::middleware(['auth'])->group(function () {
    Route::get('/produits/{id}', [ProductController::class, 'show'])->where('id', '[0-9]+')->name('produits.show');
});

// Public Product Routes
Route::get('/produits/{cat}', [ProductController::class, 'getProductsByCategorie'])->name('produits.categorie');

// Routes Statiques
Route::get('/', function () {
    return view('welcome');
})->name('root'); // Renamed to root to avoid conflict
Route::get('/categories', [HomeController::class, 'categories'])->name('categories');
Route::get('/a-propos', [HomeController::class, 'about'])->name('a_propos');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

Route::get('/contact', [App\Http\Controllers\ContactController::class, 'showContact'])->name('contact');
Route::post('/contact/send', [App\Http\Controllers\ContactController::class, 'sendTransmission'])->name('transmission.send');

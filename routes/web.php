<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;

// Route Accueil
Route::get('/', [HomeController::class, 'index'])->name('home');

// Routes ADMIN (GOD MODE)
Route::get('/admin/dashboard', [ProductController::class, 'adminDashboard'])->name('admin.dashboard');
Route::get('/admin/products', [ProductController::class, 'adminIndex'])->name('admin.products');

// Route Produits (DYNAMIQUE via Base de Données)
Route::get('/produits/create', [ProductController::class, 'create'])->name('produits.create');
Route::post('/produits', [ProductController::class, 'store'])->name('produits.store');
Route::get('/produits/{id}', [ProductController::class, 'show'])->where('id', '[0-9]+')->name('produits.show');
Route::get('/produits/{id}/edit', [ProductController::class, 'edit'])->name('produits.edit');
Route::put('/produits/{id}', [ProductController::class, 'update'])->name('produits.update');
Route::delete('/produits/{id}', [ProductController::class, 'destroy'])->name('produits.destroy');
Route::get('/produits/{cat}', [ProductController::class, 'getProductsByCategorie'])->name('produits.categorie');

// Routes Statiques
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/categories', [HomeController::class, 'categories'])->name('categories');
Route::get('/a-propos', [HomeController::class, 'about'])->name('a_propos');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
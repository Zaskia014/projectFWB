<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\User\TransactionController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\Admin\AdminBookController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\TransactionController as AdminTransactionController;
use App\Http\Controllers\Author\AuthorBookController;
use App\Http\Controllers\User\BookReviewController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\CartController;
// use App\Http\Controllers\TransactionController;


// ==========================
// HALAMAN UTAMA
// ==========================
Route::get('/', function () {
    return view('welcome');
});

// ==========================
// AUTH
// ==========================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ==========================
// REDIRECT DASHBOARD
// ==========================
Route::middleware('auth')->get('/dashboard', [AuthController::class, 'redirectToDashboard'])->name('dashboard');

// ==========================
// ADMIN ROUTES
// ==========================
Route::prefix('admin')->middleware(['auth', 'role:admin'])->name('admin.')->group(function () {
    Route::view('/dashboard', 'admin.dashboard')->name('dashboard');
    Route::resource('books', AdminBookController::class);
    Route::resource('users', UserController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('reviews', ReviewController::class);
    Route::resource('transactions', AdminTransactionController::class);
});

// ==========================
// AUTHOR ROUTES
// ==========================
Route::prefix('author')->middleware(['auth', 'role:author'])->name('author.')->group(function () {
    Route::view('/dashboard', 'author.dashboard')->name('dashboard');
    Route::resource('books', AuthorBookController::class);
    Route::get('/books/{book}/reviews', [AuthorBookController::class, 'showReviews'])->name('books.reviews');
});

// ==========================
// USER ROUTES
// ==========================
Route::prefix('user')->middleware(['auth', 'role:user'])->name('user.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [BookReviewController::class, 'buku'])->name('dashboard');

    // Buku
    Route::get('/books', [BookController::class, 'index'])->name('books.index');
    Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');

    // Review Buku
    Route::get('/books/{book}/review', [BookReviewController::class, 'create'])->name('reviews.create');
    Route::post('/books/{book}/review', [BookReviewController::class, 'store'])->name('reviews.store');
    Route::get('/reviews/{review}/edit', [BookReviewController::class, 'edit'])->name('reviews.edit');
    Route::put('/reviews/{review}', [BookReviewController::class, 'update'])->name('reviews.update');
    Route::delete('/reviews/{review}', [BookReviewController::class, 'destroy'])->name('reviews.destroy');

    // Transaksi
Route::prefix('user')->middleware(['auth', 'role:user'])->name('user.')->group(function () {
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::post('/books/{book}/buy', [TransactionController::class, 'store'])->name('transactions.store');
    Route::patch('/transactions/{id}/cancel', [TransactionController::class, 'cancel'])->name('transactions.cancel');
});

    // Profil
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Favorite
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
    Route::post('/favorites/{book}', [FavoriteController::class, 'store'])->name('favorites.store');
    Route::delete('/favorites/{book}', [FavoriteController::class, 'destroy'])->name('favorites.destroy');

    // Cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{book}', [CartController::class, 'add'])->name('cart.add');
    Route::delete('/cart/remove/{book}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
});

// ==========================
// OPSIONAL: Route publik (jika ada eksplorasi tanpa login)
// ==========================
// Route::get('/explore/books', [BookController::class, 'index'])->name('explore.books.index');
// Route::get('/explore/books/{book}', [BookController::class, 'show'])->name('explore.books.show');

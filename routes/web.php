<?php

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\PromoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GnetController;    
use App\Http\Controllers\MartabeController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\ProductSummaryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\ChatbotAdminController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Rute publik seperti halaman utama
Route::get('/', function () {
    return view('welcome');
});

// Rute ini akan bertugas mengambil dan menampilkan gambar promo
Route::get('/storage/promos/{filename}', function ($filename) {
    $path = 'promo_images/'.$filename;

    if (!Storage::disk('public')->exists($path)) {
        abort(404);
    }

    return Storage::disk('public')->response($path);
})->name('promo.image');

// routes/web.php

// Rute ini akan bertugas mengambil dan menampilkan gambar blog
Route::get('/storage/blogs/{filename}', function ($filename) {
    $path = 'blog_images/'.$filename;
    if (!Storage::disk('public')->exists($path)) {
        abort(404);
    }
    return Storage::disk('public')->response($path);
})->name('posts.image');

// Grup untuk SEMUA rute yang butuh login DAN peran 'admin'
Route::middleware(['auth', 'role:admin'])->group(function () {
    
    // Rute Dashboard untuk admin konten
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Rute postingan blog
    Route::resource('posts', PostController::class);

    // Rute untuk halaman Beranda Statistik
    Route::get('/ui-beranda', [BerandaController::class, 'index'])->name('ui-beranda.index');
    Route::post('/ui-beranda/statistics', [BerandaController::class, 'updateStatistics'])->name('ui-beranda.statistics.update');

    // ... rute beranda Promo ...
    // SATU BARIS INI untuk semua fungsionalitas CRUD Promo
    Route::resource('promos', PromoController::class);

    // Rute-rute statis lainnya
    Route::get('/ui-gnet', [GnetController::class, 'index'])->name('ui-gnet');
     Route::get('/ui-martabe', [MartabeController::class, 'index'])->name('ui-martabe');
    Route::resource('packages', PackageController::class);

    // Rute paket
   Route::get('/paket', [ProductSummaryController::class, 'index'])->name('product_summaries.index');
    Route::put('/paket/{productSummary}', [ProductSummaryController::class, 'update'])->name('product_summaries.update');

     // --- KODE UI Message ---
    Route::get('/ui-message', [MessageController::class, 'index'])->name('ui-message.index');
    Route::resource('messages', MessageController::class)->only(['destroy']);

   // Route::get('/ui-martabe', function () { return view('ui-martabe'); })->name('ui-martabe');
   //Route::get('/ui-paket', function () { return view('ui-paket'); })->name('ui-paket');
    //Route::get('/ui-blog', function () { return view('ui-blog'); })->name('ui-blog');

    // untuk halaman blog
    Route::resource('posts', PostController::class);

    //Route::get('/ui-chatbot', function () { return view('ui-chatbot'); })->name('ui-chatbot');
    // Route::get('/ui-message', function () { return view('ui-message'); })->name('ui-message');
   
    // Rute untuk Halaman Kustom Chatbot
    // --- ChatbotAdminController ---
    // Rute untuk Halaman Kustom Chatbot (Sesuai Struktur Asli Anda)
    Route::get('/ui-chatbot', [ChatbotAdminController::class, 'index'])->name('chatbot.index');
    Route::post('/ui-chatbot', [ChatbotAdminController::class, 'store'])->name('chatbot.store');
    Route::delete('/ui-chatbot/{chatbot}', [ChatbotAdminController::class, 'destroy'])->name('chatbot.destroy');
    Route::get('/ui-chatbot/{chatbot}/edit', [ChatbotAdminController::class, 'edit'])->name('chatbot.edit');
    Route::put('/ui-chatbot/{chatbot}', [ChatbotAdminController::class, 'update'])->name('chatbot.update');

    // Rute Profil untuk admin konten
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
});

// Memuat rute otentikasi (login, logout, dll.)
require __DIR__.'/auth.php';
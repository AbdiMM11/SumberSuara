<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Auth
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;

// Admin Controllers
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\ArtikelController;
use App\Http\Controllers\Admin\HeroSectionController;
use App\Http\Controllers\Admin\VerifikasiMusisiController;
use App\Http\Controllers\Admin\AkunController;

// Musisi Controllers
use App\Http\Controllers\Musisi\DashboardController as MusisiDashboardController;
use App\Http\Controllers\Musisi\MusisiProfilController;
use App\Http\Controllers\Musisi\KaryaController as MusisiKaryaController;

// Publik
use App\Http\Controllers\Public\IndexController as PublicIndexController;
use App\Http\Controllers\Public\ProfilController as PublicProfilController;

// Audiens
use App\Http\Controllers\Audiens\LaguFavoritController;

// Komentar Artikel
use App\Http\Controllers\KomentarController;

// Profile
use App\Http\Controllers\ProfileController;

require __DIR__ . '/auth.php';


/*
|--------------------------------------------------------------------------
| ROUTES ADMIN
|--------------------------------------------------------------------------
*/
Route::prefix('admin')
    ->middleware(['auth'])
    ->name('admin.')
    ->group(function () {

        // Dashboard Admin
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

        // Daftar Akun
        Route::get('/daftar/akun', [AkunController::class, 'index'])
            ->name('daftarAcc');
        Route::delete('/akun/{user}', [AkunController::class, 'destroy'])
            ->name('akun.destroy');

        // Verifikasi Musisi
        Route::get('/verifikasi/akun', [VerifikasiMusisiController::class, 'index'])
            ->name('verifikasi');
        Route::post('/verifikasi/akun/{musisi}/approve', [VerifikasiMusisiController::class, 'approve'])
            ->name('verifikasi.approve');
        Route::post('/verifikasi/akun/{musisi}/reject', [VerifikasiMusisiController::class, 'reject'])
            ->name('verifikasi.reject');

        // Hero Section
        Route::get('/hero/section', [HeroSectionController::class, 'index'])
            ->name('heroSection');
        Route::post('/hero/section', [HeroSectionController::class, 'store'])
            ->name('hero.store');

        // Event CRUD
        Route::controller(EventController::class)->group(function () {
            Route::get('/event', 'index')->name('event');
            Route::get('/event/create', 'create')->name('createEvent');
            Route::post('/event/store', 'store')->name('storeEvent');
            Route::get('/event/{event}/edit', 'edit')->name('editEvent');
            Route::put('/event/{event}', 'update')->name('updateEvent');
            Route::delete('/event/{event}', 'destroy')->name('deleteEvent');
        });

        // Artikel CRUD
        Route::controller(ArtikelController::class)->group(function () {
            Route::get('/artikel', 'adminIndex')->name('artikel');
            Route::get('/create/artikel', 'adminCreate')->name('createArtikel');
            Route::post('/artikel', 'adminStore')->name('artikel.store');
            Route::get('/artikel/{artikel}/edit', 'adminEdit')->name('editArtikel');
            Route::put('/artikel/{artikel}', 'adminUpdate')->name('artikel.update');
            Route::delete('/artikel/{artikel}', 'adminDestroy')->name('artikel.destroy');
        });
    });


/*
|--------------------------------------------------------------------------
| ROUTES PUBLIK
|--------------------------------------------------------------------------
*/

// Beranda
Route::get('/', [PublicIndexController::class, 'index'])->name('index');

// Profil publik musisi
Route::get('/musisi/{id}', [PublicProfilController::class, 'show'])
    ->whereNumber('id')
    ->name('musisi.show');

// Halaman umum
Route::view('/about', 'about')->name('about');
Route::view('/view/music', 'viewMusic')->name('viewMusic');

// Playlist Audiens
Route::get('/playlist', [LaguFavoritController::class, 'index'])->name('playlist');

// Event publik
Route::get('/event', [EventController::class, 'publicIndex'])->name('event');
Route::get('/event/{id}', [EventController::class, 'show'])->name('viewEvent');

// Artikel publik
Route::controller(ArtikelController::class)->group(function () {
    Route::get('/article', 'indexPublic')->name('article');
    Route::get('/view/artikel/{slug}', 'showPublic')->name('viewArtikel');
});


/*
|--------------------------------------------------------------------------
| KOMENTAR ARTIKEL
|--------------------------------------------------------------------------
*/
Route::post('/view/artikel/{slug}/komentar', [KomentarController::class, 'store'])
    ->middleware('auth')
    ->name('artikel.komentar.store');

Route::delete('/komentar/{id}', [KomentarController::class, 'destroy'])
    ->middleware('auth')
    ->name('komentar.destroy');


/*
|--------------------------------------------------------------------------
| LOGIN / LOGOUT
|--------------------------------------------------------------------------
*/
Route::get('/login',  [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.store');
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');


/*
|--------------------------------------------------------------------------
| REDIRECT SETELAH LOGIN
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    $user = Auth::user();

    return match ($user?->role?->nama_roles) {
        'Admin'   => redirect()->route('admin.dashboard'),
        'Musisi'  => redirect()->route('musisi.dashboard'),
        'Audiens' => redirect()->route('index'),
        default   => redirect()->route('index'),
    };
})->middleware(['auth', 'verified'])->name('dashboard');


/*
|--------------------------------------------------------------------------
| ROUTES MUSISI
|--------------------------------------------------------------------------
*/
Route::prefix('musisi')
    ->middleware(['auth'])
    ->name('musisi.')
    ->group(function () {

        // Dashboard Musisi
        Route::get('/dashboard', [MusisiDashboardController::class, 'index'])
            ->name('dashboard');

        // Profil Musisi
        Route::get('/profil',  [MusisiProfilController::class, 'edit'])->name('profil');
        Route::post('/profil', [MusisiProfilController::class, 'update'])->name('profil.update');

        // Karya
        Route::get('/karya',              [MusisiKaryaController::class, 'index'])->name('karya');
        Route::get('/karya/create',       [MusisiKaryaController::class, 'create'])->name('karya.create');
        Route::post('/karya',             [MusisiKaryaController::class, 'store'])->name('karya.store');
        Route::get('/karya/{karya}/edit', [MusisiKaryaController::class, 'edit'])->name('karya.edit');
        Route::put('/karya/{karya}',      [MusisiKaryaController::class, 'update'])->name('karya.update');
        Route::delete('/karya/{karya}',   [MusisiKaryaController::class, 'destroy'])->name('karya.destroy');
    });


/*
|--------------------------------------------------------------------------
| PROFILE + TOGGLE FAVORIT
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile',  [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Toggle favorit
    Route::post('/lagu-favorit/toggle', [LaguFavoritController::class, 'toggle'])
        ->name('lagu-favorit.toggle');
});


/*
|--------------------------------------------------------------------------
| SIGNUP FOR AUDIENCE & MUSISI
|--------------------------------------------------------------------------
*/
Route::get('/signup/audience', [RegisteredUserController::class, 'createAudience'])
    ->name('signup.audience');
Route::post('/signup/audience', [RegisteredUserController::class, 'storeAudience']);

Route::get('/signup/musisi', [RegisteredUserController::class, 'createMusisi'])
    ->name('signup.musisi');
Route::post('/signup/musisi', [RegisteredUserController::class, 'storeMusisi']);

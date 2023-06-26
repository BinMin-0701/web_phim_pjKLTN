<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\LinkMovieController;
use App\Http\Controllers\Auth\AdminLoginController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [IndexController::class, 'home'])->name('homepage');
Route::get('/danh-muc/{slug}', [IndexController::class, 'category'])->name('category');
Route::get('the-loai/{slug}', [IndexController::class, 'genre'])->name('genre');
Route::get('/quoc-gia/{slug}', [IndexController::class, 'country'])->name('country');
Route::get('/phim/{slug}', [IndexController::class, 'movie'])->name('movie');
Route::get('/xem-phim/{slug}/{tap}', [IndexController::class, 'watch'])->name('watch');
Route::get('/so-tap', [IndexController::class, 'episode'])->name('so-tap');
Route::get('/nam/{year}', [IndexController::class, 'year']);
Route::get('/tag/{tag}', [IndexController::class, 'tag']);
Route::post('/add-rating', [IndexController::class, 'add_rating'])->name('add-rating');

//Đăng ký tài khoản
Route::get('/register', [RegisterController::class, 'index']);
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/register', [RegisterController::class, 'index']);

// Tìm kiếm phim
Route::get('/tim-kiem', [IndexController::class, 'timkiem'])->name('tim-kiem');

Auth::routes();

//đăng nhập user
Route::get('/login', [LoginController::class, 'index']);
Route::post('/login_home', [LoginController::class, 'post_login']);
Route::get('/logout_user',[LoginController::class, 'logout_user']);


//Đăng nhập admin
Route::get('/admin/login', [AdminLoginController::class, 'index']);
Route::post('/admin/login', [AdminLoginController::class, 'post_login']);

Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('CheckAdminLogin');

// Admin
// ==================================
Route::resource('category', CategoryController::class)->middleware('CheckAdminLogin');
Route::post('resorting', [CategoryController::class,'resorting'])->name('resorting')->middleware('CheckAdminLogin');
Route::resource('genre', GenreController::class)->middleware('CheckAdminLogin');
Route::resource('country', CountryController::class)->middleware('CheckAdminLogin');
Route::resource('linkmovie', LinkMovieController::class)->middleware('CheckAdminLogin');
// them tập phim
Route::get('add-episode/{id}', [EpisodeController::class, 'add_episode'])->name('add-episode')->middleware('CheckAdminLogin');
Route::resource('episode', EpisodeController::class)->middleware('CheckAdminLogin');
Route::get('select-movie', [EpisodeController::class, 'select_movie'])->name('select-movie')->middleware('CheckAdminLogin');

Route::resource('movie', MovieController::class)->middleware('CheckAdminLogin');
Route::get('/update-year-phim', [MovieController::class, 'update_year'])->middleware('CheckAdminLogin');
Route::get('/update-topview-phim', [MovieController::class, 'update_topview'])->middleware('CheckAdminLogin');
Route::get('/filter-topview-phim', [MovieController::class, 'filter_topview'])->middleware('CheckAdminLogin');
Route::get('/filter-topview-default', [MovieController::class, 'filter_default'])->middleware('CheckAdminLogin');
Route::get('/update-season-phim', [MovieController::class, 'update_season'])->middleware('CheckAdminLogin');


<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ControllerComment;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*
Route::get('/', function () {
    return view('welcome');
});
*/


// Main
Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/all',[HomeController::class, 'all'])->name('home.all');

// Administrator
Route::get('/admin', [AdminController::class, 'index'])
            ->middleware('can:admin.index')
            ->name('admin.index');

// Admin routes
Route::namespace('App\Http\Controllers')->prefix('admin')->group(function(){
    // Articles
    Route::resource('articles', 'ArticleController')
            ->except('show')
            ->names('articles');
    // Categories
    Route::resource('categories', 'CategoryController')
    ->except('show')
    ->names('categories');
    // Commentaries
    Route::resource('comments', 'ControllerComment')
        ->only('index', 'destroy')
        ->names('comments');

    // Users
    Route::resource('users', 'UserController')
                    ->except('create', 'store', 'show')
                    ->names('users');

    // Roles
    Route::resource('roles', 'RoleController')
                ->except('show')
                ->names('roles');

});

// Profiles and import 'use App\Http\Controllers\ProfileController;' at the beginning
Route::resource('profiles', ProfileController::class)
            ->only('show','edit', 'update')
            ->names('profiles');

// See articles
Route::get('articles/{article}', [ArticleController::class, 'show'])->name('articles.show');

// See articles by categories
Route::get('category/{category}', [CategoryController::class, 'detail'])->name('categories.detail');

// Save commentaries
Route::post('/comments',[ControllerComment::class, 'store'])->name('comments.store');

Auth::routes(); // It is normally put at the end.
/* 
Route::get('/articles',[ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/create',[ArticleController::class, 'create'])->name('articles.create');
Route::post('/artilces',[ArticleController::class, 'store'])->name('articles.store');

Route::get('/articles/{article}/edit',[ArticleController::class, 'edit'])->name('articles.edit');
Route::put('/articles/{article}', [ArticleController::class, 'update'])->name('articles.update');
Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show');
Route::delete('/article/{article}',[ArticleController::class, 'destroy'])->name('articles.destroy');

*/

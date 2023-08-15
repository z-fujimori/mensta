<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;


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

Route::controller(PostController::class)->middleware(['auth'])->group(function(){
    Route::get('/','index')->name('index');
    Route::get('/map','map')->name('map');
    Route::get('/posts/create','create')->name('create');
    Route::get('/posts/{post}','show')->name('show');
    Route::get('/users/{user}','user')->name('user');
    Route::get('/cand','cand')->name('cand');
    Route::post('/candidate', 'candidate')->name('candidate');
    Route::post('/posts', 'store')->name('store');
    Route::get('/resta','resta')->name('resta');
    Route::post('/like_product','like_product')->name('like_product');
    Route::post('/like', 'ReviewController@like')->name('reviews.like');
    Route::post('/posts/{post}/comment', 'comment')->name('comment');
    Route::get('/tags/{tag}','tag_page')->name('tag_page');
    
    Route::get('/mypage','mypage')->name('mypage');
    Route::get('/posts/{post}/edit', 'edit')->name('edit');
    Route::put('/posts/{post}', 'update')->name('update');
    Route::delete('/posts/{post}','delete')->name('delete');
    
    Route::get('/test-map','test')->name('test');
});


//Route::get('/', function () { return view('welcome'); });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

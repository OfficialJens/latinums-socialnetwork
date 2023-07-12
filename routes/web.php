<?php

use Illuminate\Support\Facades\Route;

// --- [#] Non-Auth Route (Gast) [#] --- //
Route::redirect('/', 'login');

// --- [#] Auth Routes [#] --- //
Auth::routes();

// --- [#] Uitloggen [#] --- //
Route::get('afmelden', [App\Http\Controllers\LogoutController::class, 'logout']);

// --- [#] Dashboard Routes (Home) [#] --- //
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/instellingen', [App\Http\Controllers\GebruikerEditController::class, 'index'])->name('instellingen');

// --- [#] Gebruiker Instellingen Routes [#] --- //
Route::put('instellingen', [App\Http\Controllers\GebruikerEditController::class,'update'])->name('instellingen.update');
Route::put('avatar', [App\Http\Controllers\GebruikerEditController::class,'store'])->name('avatar.store');

// --- [#] Gebruiker Profiel Routes [#] --- //
Route::get('/gebruiker-zoeken', [App\Http\Controllers\GebruikerController::class, 'index'])->name('zoekGebruiker');
Route::get('gebruiker/zoekresultaat', [App\Http\Controllers\GebruikerController::class, 'search'])->name('zoekGebruiker.search');
Route::get('gebruiker/{id}', [App\Http\Controllers\GebruikerController::class, 'profiel'])->name('zoekGebruiker.profiel');
Route::post('gebruiker-follow/{id}', [App\Http\Controllers\GebruikerController::class, 'followUser'])->name('gebruiker.follow');
Route::post('gebruiker-unFollow/{id}', [App\Http\Controllers\GebruikerController::class, 'unFollowUser'])->name('gebruiker.unFollow');

// --- [#] Social Post Routes [#] --- //
Route::get('/posts/{id}', [App\Http\Controllers\PostController::class,'show'])->name('posts.show');
Route::post('like-post/{id}', [App\Http\Controllers\PostController::class,'likePost'])->name('like.post');
Route::post('unlike-post/{id}', [App\Http\Controllers\PostController::class,'unlikePost'])->name('unlike.post');
Route::get('/posts/delete/{id}', [App\Http\Controllers\PostController::class, 'delete'])->name('posts.delete');

// --- [#] Social Post Comments Routes [#] --- //
Route::post('create-post', [App\Http\Controllers\HomeController::class,'storePost'])->name('posts.store');
Route::post('comment-post', [App\Http\Controllers\HomeController::class,'storeComment'])->name('comments.store');
Route::get('/comment/{id}', [App\Http\Controllers\HomeController::class, 'delete'])->name('comment.delete');

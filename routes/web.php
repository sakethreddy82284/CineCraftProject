<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\athenticateController; 
use App\Http\Controllers\MovieController;
use App\Http\Controllers\TvshowController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserReviewController;
use App\Http\Controllers\WatchlistController;



Route::get('/',function(){
    return redirect()->route('register');
});





Route::middleware('if_athenticate')->group(function(){
    Route::get('/login',[athenticateController::class,'index'])->name('register');
});



Route::post('/store',[athenticateController::class,'register'])->name('register.store');
Route::post('/login',[athenticateController::class,'login'])->name('login.store');





Route::middleware('jwt')->group(function(){
    Route::get('/userdashboard', [UserController::class,'dashboard'])->name('userdash');
    Route::get('/moviecard/{id}',[UserController::class,'movie_card'])->name('moviecard'); 
    Route::post('/logout', [athenticateController::class, 'logout'])->name('logout');
    Route::post('/review/store',[UserReviewController::class,'store'])->name('postreview');
    Route::get('/tvshowcard/{id}',[UserController::class,'tvshow_card'])->name('tvshowcard');
    Route::get('/tvshowcardcard/{id}',[UserController::class,'tvshow_card'])->name('tvshowcardcard'); 
    Route::post('/tvshowreview',[UserReviewController::class,'storetvshowreview'])->name('posttvshowreviewreview');
    Route::get('/search',[UserController::class,'search'])->name('search');

    Route::get('/yourwashlist',[WatchlistController::class,'index'])->name('yourwatchlist');
    Route::post('/watchlist/{id}',[WatchlistController::class,'store'])->name('watchliststore');
    Route::delete('/deletewatchlist/{id}', [WatchlistController::class, 'destroy'])->name('watchlistdelete');

    Route::get('/alltvshows', [UserController::class,'alltvshows'])->name('alltvshows');
    Route::get('/allmovies', [UserController::class,'allmovies'])->name('allmovies');

});










Route::middleware(['jwt', 'role'])->group(function(){
    Route::get( '/admindash', [AdminController::class,'dashboard'])->name('admindashboard');
    Route::get( '/adminadmindash', [AdminController::class,'dashboard'])->name('backtodash');

    
    Route::get('/showmovies', [MovieController::class, 'index'])->name('showmovies');
    Route::get('/movieadd', [MovieController::class, 'create'])->name('addmovie');
    Route::post('/movieadding', [MovieController::class, 'store'])->name('addingmovie');
    Route::get('/showmovie/{tmdb}', [MovieController::class, 'show'])->name('showmovie');
    Route::get('/editpage/{id}', [MovieController::class, 'edit'])->name('editpage');
    Route::put('/update/{id}', [MovieController::class, 'update'])->name(name: 'update');
    Route::delete('/deletemovie/{id}', [MovieController::class, 'destroy'])->name('deltemovie');



    Route::get('/showtvshow', [TvshowController::class, 'index'])->name('showtvshow');
    Route::get('/Tvshowadd', [TvshowController::class, 'create'])->name('addtvshow');
    Route::post('/tvshowadding', [TvshowController::class, 'store'])->name('addingtvshow');
    Route::get('/edittvshowpage/{id}', [TvshowController::class, 'edit'])->name('edittvshowpage');
    Route::put('/updatetshow/{id}', [TvshowController::class, 'update'])->name( 'updatetvshow');
    Route::delete('/deletetvshow/{id}', [TvshowController::class, 'destroy'])->name('deletetvshow');



     
});
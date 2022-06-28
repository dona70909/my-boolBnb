<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes();

Route::get('/home', 'Guest\HomeController@index')->name('home.');

Route::middleware('auth')->prefix('admin')->namespace('Admin')->name('admin.')->group(function(){

    Route::get('home', 'HomeController@index')->name('home');
    Route::get('sponsorize/{apartment}', 'SponsorshipController@sponsorize')->name('sponsorize');
    

    //store ponsors
    Route::get('/sponsorships/store', 'SponsorshipController@store')->name('sponsor.store');


    Route::resource('error', 'ErrorController');
    Route::resource('sponsorships', 'SponsorshipController');
    Route::resource('apartments','ApartmentController');
    Route::resource('message','MessageController');
});



// QUALSIASI ROTTA NON RICONOSCIUTA PORTERA' ALLA HOME PAGE DI BOOL-BNB
Route::get("{any?}", function(){
    return view('guest.home');
})->where('any', '.*'); 

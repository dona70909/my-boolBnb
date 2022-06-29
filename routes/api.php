<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/* Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
}); */
// singolo appartamento esposto via API
// tutti gli appartamenti esposti via API
Route::get('/apartments', 'Api\ApartmentController@index');
Route::get('/apartments/single/{id}', 'Api\ApartmentController@show');


// %SEARCH WIT DEFAULT INPUT VALUES AND 
//#SEARCH FILTERED WITHE THE INPUT FROM THE USERS
Route::get('/apartments/search', 'Api\ApartmentController@search');
Route::get('/apartments/filteredsearch', 'Api\ApartmentController@filteredSearch');

//%SERVICES CONTROLLER INDEX
Route::get('/services', 'Api\ServicesController@index');

//& check payment data and go to the store
Route::post("/make/payment", "Api\PaymentController@makePayment")->name('payment');

//# store message from any user and required email e content
Route::post('/message', 'Api\MessageController@store');

// !! non riesco a prendere le immagini relative ad un appartamento 
//!! SONO STUPIDA!
Route::get('/images/apartment', 'Api\ImagesController@filterImages');

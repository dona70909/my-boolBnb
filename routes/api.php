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



Route::get('/apartments/search', 'Api\ApartmentController@search');
Route::get('/apartments/filteredsearch', 'Api\ApartmentController@filteredSearch');
Route::get('/services', 'Api\ServicesController@index');

Route::post("/make/payment", "Api\PaymentController@makePayment")->name('payment');

Route::post('/message', 'Api\MessageController@store');

// !! non riesco a prendere le immagini relative ad un appartamento 
//!! SONO STUPIDA!
//Route::get('/images', 'Api\ApartmentController@apartmentImages');
//Route::get('/images/apartment', 'Api\ImagesController@show');
Route::get('/images', 'Api\ImagesController@index');
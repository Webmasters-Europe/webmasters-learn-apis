<?php

use Illuminate\Support\Facades\Route;

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

Route::pattern('domain', config('settings.domain_pattern'));

// Route::domain(config('settings.swapi_url'))->group(function () {
//     Route::view('/documentation', 'documentation.swapi')->name('documentation.swapi');
// });
Route::domain(config('settings.swapi_url'))->get('/documentation', function () {
    return view('documentation.swapi', ['domain' => request()->route('domain')]);
})->name('documentation.swapi');

Route::domain(config('settings.solar_url'))->get('/documentation', function () {
    return view('documentation.solar', ['domain' => request()->route('domain')]);
})->name('documentation.solar');

Route::domain(config('settings.api_url'))->get('/', function () {
    return view('welcome', ['domain' => request()->route('domain')]);
});

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

Route::get('/', function () {
   // return view('welcome');
   return view('listing');
});

Route::get('/provider/create', function () {
    // return view('welcome');
    return view('company');
 });

 Route::get('/provider/edit', function () {
    // return view('welcome');
    return view('EditCompany');
 });

 Route::post('/provider/save','CompanyController@store');
 Route::get('/provider/list','CompanyController@index');
 Route::get('/provider/getCompany','CompanyController@GetCompanyName');
 Route::get('/provider/getCompanyInfo','CompanyController@edit');
 Route::post('/provider/update','CompanyController@updateCompany');
 Route::post('/provider/del','CompanyController@removeCompany');




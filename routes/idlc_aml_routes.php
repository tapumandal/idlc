<?php

Route::get('/ifa-registration-form', 'IFARegistrationController@index')->name('ifa_registration.index');
Route::get('/ifa-registration-form/create', 'IFARegistrationController@create')->name('ifa_registration.create');
Route::post('/ifa-registration-form', 'IFARegistrationController@store')->name('ifa_registration.store');


Route::resource('divisions', 'DivisionController');
Route::resource('districts', 'DistrictController');
Route::resource('thanas', 'ThanaController');
Route::resource('banks', 'BankController');
Route::resource('branchs', 'BranchController');
Route::resource('/nationalitys', 'NationalityController');
Route::resource('/premiseOwnerships', 'PremiseOwnershipController');

Route::any('/get/division', 'ThanaController@showDivision');
Route::any('/get/div/dis/thanas', 'ThanaController@getThanas');
Route::any('/get/bank/branch', 'BranchController@getBranch');

Route::post('/value/check/mobile', 'LiveValidation@mobileNoValidate');
Route::post('/value/check/email', 'LiveValidation@emailValidate');
Route::post('/value/check/national_id_card_no', 'LiveValidation@nidValidate');

Route::get('/ifa-registration-form/login', 'IFA/IFALoginController@showLoginForm')->name('ifa_registration.loginview');
Route::post('/ifa-registration-form/login', 'IFA/IFALoginController@login')->name('ifa_registration.loginview');

Route::group(['middleware' => 'auth'], function(){
    Route::get('/ifa-registration-form/edit', 'IFARegistrationController@edit')->name('ifa_registration.edit');
    Route::post('/ifa-registration-form/edit', 'IFARegistrationController@postEdit')->name('ifa_registration.postEdit');
    Route::put('/ifa-registration-form/{application_no}', 'IFARegistrationController@update')->name('ifa_registration.update');

});
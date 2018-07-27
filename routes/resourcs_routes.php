<?php 

Route::resource('divisions', 'DivisionController');
Route::resource('districts', 'DistrictController');
Route::resource('thanas', 'ThanaController');
Route::resource('banks', 'BankController');
Route::resource('branchs', 'BranchController');

Route::any('get/division','ThanaController@showDivision');
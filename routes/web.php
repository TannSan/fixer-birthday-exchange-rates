<?php
Route::resource('/', 'BirthdayExchangeRateController');
Route::get('/{birthday}', 'BirthdayExchangeRateController@create');
<?php

Route::group(['prefix' => 'debug', 'namespace' => 'Lingxi\Hashids\Controllers'], function () {

    Route::get('/en/{id}', 'DebugController@en');

    Route::get('/de/{id}', 'DebugController@de');

});


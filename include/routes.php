<?php

Route::group(['prefix' => 'debug', 'namespace' => 'Lingxi\Hashids\Controllers'], function () {

    Route::get('/debug/en/{id}', 'DebugController@en');

    Route::get('/debug/de/{id}', 'DebugController@de');

});


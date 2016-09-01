<?php

Route::get('/debug/en/{id}', function ($id) {
    dd(publicId($id, request('c')));
});

Route::get('/debug/de/{id}', function ($id) {
    dd(trueId($id, request('c')));
});

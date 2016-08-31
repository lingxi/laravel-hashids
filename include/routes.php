<?php

Route::get('/debug/en/{id}', function ($id) {
    dd(publicId($id));
});

Route::get('/debug/de/{id}', function ($id) {
    dd(trueId($id));
});

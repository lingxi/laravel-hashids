<?php

use Lingxi\Hashids\Hashids;

if (! function_exists('true_id')) {
    function true_id($publicId, $connection = null) {
        return Hashids::trueId($publicId, $connection);
    }
}

if (! function_exists('trueId')) {
    function true_id($publicId, $connection = null) {
        return Hashids::trueId($publicId, $connection);
    }
}

if (! function_exists('public_id')) {
    function true_id($id, $connection = null) {
        return Hashids::publicId($id, $connection);
    }
}

if (! function_exists('publicId')) {
    function true_id($id, $connection = null) {
        return Hashids::publicId($id, $connection);
    }
}

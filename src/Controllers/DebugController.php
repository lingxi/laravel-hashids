<?php

namespace Lingxi\Hashids\Controllers;

use Illuminate\Routing\Controller;

class DebugController extends Controller
{
    public function en($id)
    {
        dd(publicId($id, request('c')));
    }

    public function de()
    {
        dd(trueId($id, request('c')));
    }
}

<?php

namespace Lingxi\Hashids\Controllers;

use Lingxi\Hashids\Hashids;
use Illuminate\Routing\Controller;

class DebugController extends Controller
{
    public function en($id)
    {
        dd(Hashids::publicId($id, request('c')));
    }

    public function de($id)
    {
        dd(Hashids::trueId($id, request('c')));
    }
}

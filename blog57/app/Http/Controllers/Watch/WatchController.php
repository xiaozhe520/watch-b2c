<?php
namespace  App\Http\Controllers\Watch;

use App\Http\Controllers\Controller;

class WatchController extends Controller
{
    public function index()
    {
        return view('watch/index');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reading;
use App\User;
use App\Stoplight;

class PagesController extends Controller
{
    public function index(Request $request) {
        $readings = Reading::all();
        $stoplights = Stoplight::all();
        return view('welcome', compact('readings'), compact('stoplights'));
    }
}

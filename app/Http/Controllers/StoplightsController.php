<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Stoplight;
use App\Http\Requests;

class StoplightsController extends Controller
{
    public function index(Request $request) {
        $stoplights = Stoplight::all();

        return view('stoplights.index', compact('stoplights'));
    }
}


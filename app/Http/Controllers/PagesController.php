<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reading;
use App\User;

class PagesController extends Controller
{
    public function index(Request $request) {
        $readings = Reading::all();
        return view('welcome', compact('readings'));
    }
}

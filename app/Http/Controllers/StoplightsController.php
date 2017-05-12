<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Stoplight;
use App\Http\Requests;

class StoplightsController extends Controller
{
    public function index(Request $request) {
        $stoplights = Stoplight::all();

        return view('stoplights.index', compact('stoplights'));
    }

    public function reset(Request $request) {

        DB::table('stoplights')
            ->where('stoplight_id', $request->id)
            ->update(array('status' => 1, 'error' => 'Not Defective'));
        DB::table('readings')
            ->where('stoplight_id', $request->id)
            ->delete();
        return redirect('/');
    }
}


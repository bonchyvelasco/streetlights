<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reading;

class ReadingsController extends Controller
{
    public function addReading(Request $request) {

        $this->validate($request, [
            'red' => "required|integer",
            'green' => "required|integer",
            'blue' => "required|integer",
            'id' => "required|integer"
        ]);

        $reading = new Reading;
    
        $reading->r = $request->red;
        $reading->g = $request->red;
        $reading->b = $request->red;
        $reading->stoplight_id = $request->red;
        $reading->time = date("Y-m-d H:i:s");

        $reading->save();

        $readings = Reading::all();

        return view('welcome', compact('readings'));
    }

    public function addReadingForm() {
        return view('reading.add');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Reading;
use App\User;
use App\Stoplight;

class PagesController extends Controller
{
public function compare($state, $test){
	    $counter = 0;

	    for($i = 0; $i < 3; $i++){
	        if ($state[$i] == $test[$i]) $counter++;
	    }

	    if ($counter == 3) return true;
	    else return false;
	}

    public function check_pattern($prev_state, $prev_y_state, $curr_state){

        if ($prev_state != null && $prev_y_state != null){
            if ($this->compare($curr_state, array(1, 0, 0)) == true && $this->compare($prev_state, array(0, 1, 0)) == true && $this->compare($prev_y_state, array(0, 0, 1)) == true) return true;
            if ($this->compare($curr_state, array(0, 0, 1)) == true && $this->compare($prev_state, array(0, 1, 0)) == true &&  $this->compare($prev_y_state, array(1, 0, 0)) == true) return true;
            if ($this->compare($curr_state, array(0, 1, 0)) == true && $this->compare($prev_state, array(1, 0, 0)) == true &&  $this->compare($prev_y_state, array(0, 1, 0)) == true) return true;
            if ($this->compare($curr_state, array(0, 1, 0)) == true && $this->compare($prev_state, array(0, 0, 1)) == true &&  $this->compare($prev_y_state, array(0, 1, 0)) == true) return true;
        
        }
        else if ($prev_state != null){
            if ($this->compare($prev_state, array(1, 0, 0)) == true && $this->compare($curr_state, array(0, 1, 0)) == true) return true;
            if ($this->compare($prev_state, array(0, 0, 1)) == true && $this->compare($curr_state, array(0, 1, 0)) == true) return true;
            if ($this->compare($prev_state, array(0, 1, 0)) == true && $this->compare($curr_state, array(1, 0, 0)) == true) return true;
            if ($this->compare($prev_state, array(0, 1, 0)) == true && $this->compare($curr_state, array(0, 0, 1)) == true) return true;
        }
        else{
            if ($this->compare($curr_state, array(1, 0, 0)) == true) return true;
            if ($this->compare($curr_state, array(0, 1, 0)) == true) return true;
            if ($this->compare($curr_state, array(0, 0, 1)) == true) return true;
        }
    
        return false;
    }

    public function index(Request $request) {
        header("refresh: 10;");
        $readings = Reading::
                    orderBy('time', 'desc')->get();
        $stoplights = Stoplight::all();

        foreach($stoplights as $stoplight) {
            $previousValue = null; 
            $previousValue_y = null; 
            foreach ($readings as $reading) {
                if($stoplight->stoplight_id == $reading->stoplight_id) {
                
                $pattern = 0;
                $duration = 0;                               

                if ($previousValue != null) $prev_state = array($previousValue->r, $previousValue->y, $previousValue->g);
                if ($previousValue_y != null) $prev_y_state = array($previousValue_y->r, $previousValue_y->y, $previousValue_y->g);
                $curr_state = array($reading->r, $reading->y, $reading->g);
            
                //STAGE 0 - TOO LONG
                date_default_timezone_set('Asia/Manila');

                // return (strtotime(date("Y-m-d H:i:s")))- strtotime($reading->time) ;
                if ($previousValue == null &&  abs(strtotime(date("Y-m-d H:i:s")) - strtotime($reading->time))  > 180) {
                    $duration = 3;
                }


                //STAGE 1 - PATTERN
                if ($previousValue!= null && $previousValue_y!= null){

                    if ($this->check_pattern($prev_state, $prev_y_state, $curr_state) == true) $pattern = 1;
                }
                else if($previousValue!= null){
                    if ($this->check_pattern($prev_state, null, $curr_state) == true) $pattern = 1;
                }
                else{

                    if ($this->check_pattern(null, null, $curr_state) == true) $pattern = 1;
                }

                //STAGE 2 - TIME
                if ($previousValue!= null){
                    if (strtotime($previousValue->time) - strtotime($reading->time) >= 1 && strtotime($previousValue->time) - strtotime($reading->time) <= 120){
                        $duration = 1;
                    }
                    else if (strtotime($previousValue->time) - strtotime($reading->time) < 1) $duration = 2;
                    else $duration = 3; 
                }

                //EVALUATE
                if ($previousValue== null){
                    if ($duration == 3) {
                        DB::table('stoplights')
                        ->where('stoplight_id', $reading->stoplight_id)
                        ->update(array('status' => 0, 'error' => "Stuck at one color"));
                        break;
                    } else if ($pattern == 1) {
                        DB::table('stoplights')
                        ->where('stoplight_id', $reading->stoplight_id)
                        ->update(array('status' => 1, 'error' => "Not defective"));
                    } else if ($this->compare($curr_state, array(0, 0, 0))) {
                        // return $pattern;
                        DB::table('stoplights')
                        ->where('stoplight_id', $reading->stoplight_id)
                        ->update(array('status' => 0, 'error' => "Defective: no color is on"));
                        break;
                    } else {
                        DB::table('stoplights')
                        ->where('stoplight_id', $reading->stoplight_id)
                        ->update(array('status' => 0, 'error' => "Defective: more than one color is on"));
                        break;
                    }
                }
                else{
                    if ($pattern == 1 && $duration == 1){
                        DB::table('stoplights')
                        ->where('stoplight_id', $reading->stoplight_id)
                        ->update(array('status' => 1, 'error' => "Not defective"));
                    }
                    else if ($pattern == 0 && $duration == 1){
                        DB::table('stoplights')
                        ->where('stoplight_id', $reading->stoplight_id)
                        ->update(array('status' => 0, 'error' => "Defective: sequence is incorrect"));
                    }
                    else if ($pattern == 1){
                        if ($duration == 2){
                            DB::table('stoplights')
                            ->where('stoplight_id', $reading->stoplight_id)
                            ->update(array('status' => 0, 'error' => "Defective: duration is too short"));
                        }
                        else{
                            DB::table('stoplights')
                            ->where('stoplight_id', $reading->stoplight_id)
                            ->update(array('status' => 0, 'error' => "Defective: duration is too long"));
                        }
                    }
                    else if ($pattern == 0){
                        if ($duration == 2){
                            DB::table('stoplights')
                            ->where('stoplight_id', $reading->stoplight_id)
                            ->update(array('status' => 0, 'error' => "Defective: sequence is incorrect and duration is too short."));
                        }
                        else{
                            DB::table('stoplights')
                            ->where('stoplight_id', $reading->stoplight_id)
                            ->update(array('status' => 0, 'error' => "Defective: sequence is incorrect and duration is too long."));
                        }
                    }
                    
                    if ($previousValue_y != NULL) {
                        break;
                    }
                }
                $previousValue_y = $previousValue;
                $previousValue = $reading;
                }
		    }
		}
        $readings = Reading::
            orderBy('time', 'desc')->get();
        $stoplights = Stoplight::all();

       	return view('welcome', compact('readings','stoplights'));
    }

    public function about() {
        return view('about');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Reading;
use App\User;
use App\Stoplight;
header("refresh: 10;");

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
                        if ($this->compare($prev_state, array(1, 0, 0)) == true && $this->compare($curr_state, array(0, 1, 0)) == true) return true;
                        if ($this->compare($prev_state, array(0, 0, 1)) == true && $this->compare($curr_state, array(0, 1, 0)) == true) return true;
                        if ($this->compare($prev_state, array(0, 1, 0)) == true && $this->compare($prev_y_state, array(0, 0, 1)) == true && $this->compare($curr_state, array(1, 0, 0)) == true) return true;
                        if ($this->compare($prev_state, array(0, 1, 0)) && $this->compare($prev_y_state, array(1, 0, 0)) && $this->compare($curr_state, array(0, 0, 1))) return true;
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

                public function sec($timestamp){
                    $i = 0;
                    $hours = "";
                    $minutes = "";
                    $seconds = "";
                    $time;

                    while($timestamp[$i] != " ") $i++;

                    for ($j = 0; $j < 3; $j++){
                        while($timestamp[$i] != ":"){
                            if ($j == 0) $hours += $timestamp[$i];
                            else if ($j == 1) $minutes += $timestamp[$i];
                            else $seconds += $timestamp[$i];
                            
                            if ($j < 2) $i++;
                            else break;
                        }

                        $i++;
                    }

                    $time = (intval($hours) * 3600) + (intval($minutes) * 60) + intval($seconds);
                    return $time;        
                }

                //MAIN
    public function index(Request $request) {
        $readings = Reading::all();
        $stoplights = Stoplight::all();

        foreach($stoplights as $stoplight):
    		$previousValue = null; 
    		$previousValue_y = null; 
    		foreach ($readings as $reading):
        		if($stoplight->id == $reading->stoplight_id):
   
                $pattern = 0;
                $duration = 0;                               

                if ($previousValue!= null) $prev_state = array($previousValue->r, $previousValue->y, $previousValue->g);
                if ($previousValue_y!= null) $prev_y_state = array($previousValue_y->r, $previousValue_y->y, $previousValue_y->g);
                $curr_state = array($reading->r, $reading->y, $reading->g);
                
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
                    if ($this->sec($reading->time) - $this->sec($previousValue->time) >= 1 && $this->sec($previousValue_y->time) - $this->sec($prev_reading[4]) <= 500){
                        $duration = 1;
                    }
                    else if ($this->sec($reading->time) - $this->sec($previousValue->time) < 1) $duration = 2;
                    else $duration = 3;
                }

                //EVALUATE
                if ($previousValue== null){
                    if ($pattern == 1) {
                        //echo "Not defective";

                        DB::table('readings')
			            ->where('reading_id', $reading->reading_id)
			            ->update(['status' => 1]);
                    }
                    else if ($this->compare($curr_state, array(0, 0, 0))) {
                        //echo "Defective: no color is on";

                        DB::table('readings')
			            ->where('reading_id', $reading->reading_id)
			            ->update(['status' => 0]);
                    }
                    else{
                        //echo "Defective: more than one color is on"; 

                        DB::table('readings')
			            ->where('reading_id', $reading->reading_id)
			            ->update(['status' => 0]);
                    }
                }
                else{
                    if ($pattern == 1 && $duration == 1){
                        //echo "Not defective";

                        DB::table('readings')
			            ->where('reading_id', 1)
			            ->update(['status' => 1]);
                    }
                    else if ($pattern == 0 && $duration == 1){
                        //echo "Defective: sequence is incorrect";

                        DB::table('readings')
			            ->where('reading_id', $reading->reading_id)
			            ->update(['status' => 0]);
                    }
                    else if ($pattern == 1){
                        if ($duration == 2){
                            echo "Defective: duration is too short";
                        }
                        else{
                            echo "Defective: duration is too long";
                        }

                        DB::table('readings')
			            ->where('reading_id', $reading->reading_id)
			            ->update(['status' => 0]);
                    }
                    else if ($pattern == 0){
                        if ($duration == 2){
                            echo "Defective: sequence is incorrect and duration is too short.";
                        }
                        else{
                            echo "Defective: sequence is incorrect and duration is too long.";
                        }

                        DB::table('readings')
			            ->where('reading_id', $reading->reading_id)
			            ->update(['status' => 0]);
                    }
                }
                
                $previousValue_y = $previousValue;
                $previousValue = $reading;
           
        endif;
    endforeach;
endforeach;
        return view('welcome', compact('readings','stoplights'));
    }

    public function about() {
        return view('about');
    }
}

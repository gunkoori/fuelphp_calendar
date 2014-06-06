<?php
namespace Model;
use \DB;

class Schedule extends \Model
{
    public function insert() {
        
    }

    public function update() {
    
    }

    public function get_schedule() {
        $tool = new Tool();
        $betwen_start_and_end = $tool->schedulesGet();
        $start_date = $betwen_start_and_end['start_date'];
        $finish_date = $betwen_start_and_end['finish_date'];
        //var_dump($start_date);
        //var_dump($finish_date);


        $result=DB::query('SELECT schedule_id, start_date, end_date, schedule_title, schedule_detail FROM cal_schedules WHERE deleted_at IS NULL AND start_date BETWEEN "$start_date" AND "$finish_date')->execute(); 
        return $result->as_array();
    } 

}

<?php

class Model_Schedule extends \Model
{
    public function insert() {
        
    }

    public function update() {
    
    }

    public function get_schedule($start_date, $end_date) {

    //SQL生成
$sql=<<<END
    SELECT
        schedule_id, start_date, end_date, schedule_title, schedule_detail 
    FROM 
        cal_schedules 
    WHERE 
        deleted_at 
    IS 
        NULL 
    AND 
        start_date 
    BETWEEN 
        "$start_date" 
    AND 
        "$end_date"
END;

        //実行
        $result = DB::query($sql)->execute();;

        return $result->as_array();

    } 

}

<?php

class Model_Schedule extends \Model
{
    public function insert() {

     //SQL生成
$sql=<<<END
    INSERT INTO
         cal_schedules
     SET
        start_date="$start_day",
        end_date="$end_day",
        schedule_title="$schedule_title",
        schedule_detail="$schedule_detail",
        update_at=NOW(),
        created_at=NOW(),
        deleted_at=null
END;


         //実行
        $result = DB::query($sql)->execute();

        return $result->as_array();

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
        $result = DB::query($sql)->execute();

        return $result->as_array();

    } 

}

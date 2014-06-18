<?php

class Model_Schedule extends \Model
{
    //登録
    /*
     *
     *
     *
     *
     * */
    public function insert($start_day, $end_day, $schedule_title, $schedule_detail) {

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
        return $result;
    }

    //編集
    /*
     *
     *
     *
     *
     * */
    public function update($start_day, $end_day, $schedule_title, $schedule_detail, $schedule_id) {

$sql=<<<END
    UPDATE
         cal_schedules
     SET
        start_date="$start_day",
        end_date="$end_day",
        schedule_title="$schedule_title",
        schedule_detail="$schedule_detail",
        update_at=NOW()
     WHERE
        schedule_id="$schedule_id"
END;


        //実行
        $result = DB::query($sql)->execute();
        return $result;
    }

    //カレンダーに表示する予定の取得
    /*
     *
     *
     *
     * */
    public function get_schedule_few_months($start_date, $end_date) {

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

    /*該当する予定の取得
     *
     *
     * */
    public function get_schedule($schedule_id) {

$sql=<<<END
    SELECT
         schedule_id, start_date, end_date, schedule_title, schedule_detail
     FROM
         cal_schedules
     WHERE
         schedule_id="$schedule_id"

     AND
         deleted_at
     IS
         null

END;

    //実行
    $result = DB::query($sql)->execute();
    return $result;

    } 

}

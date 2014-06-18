<?php
Class Controller_Post extends Controller_Rest
{
    public function action_insert()
    {

        $tool = new Tool_Tool();
        $schedule = new Model_Schedule();
        return $this->response('ttt');
    
    }


     public function action_schedule($schedule_id = 1) {
         $schedule_id = Input::post('schedule_id');

$sql=<<<END
    SELECT
         schedule_id, start_date, end_date, schedule_title, schedule_detail
     FROM
         cal_schedules
     WHERE
         schedule_id=$schedule_id

     AND
         deleted_at
     IS
         null

END;

    //実行
    $result = DB::query($sql)->execute();
    //echo Debug::Dump($result);
    return $this->response($result[0]);

    }
}

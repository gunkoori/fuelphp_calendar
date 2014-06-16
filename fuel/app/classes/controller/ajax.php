<?php
Class Controller_Ajax extends Controller_Rest
{
    public function insert()
    {

        $tool = new Tool_Tool();
        $schedule = new Model_Schedule();

        $insert = $model_schedule->insert($_POST);
        var_dump('ajax!!!!!'.$_POST)
    }
}

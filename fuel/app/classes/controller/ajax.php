<?php
Class Controller_Ajax extends Controller_Rest
{
    public function insert()
    {

        $tool = new Tool_Tool();
        $schedule = new Model_Schedule();

        //$insert = $schedule->insert(     );
        $title = Input::post('sch_title');
        var_dump($title);
    }
}

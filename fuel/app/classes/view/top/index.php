<?php

class View_Top_Index extends ViewModel
{
	/**
	 * Prepare the view data, keeping this in here helps clean up
	 * the controller.
	 *
	 * @return void
	 */
	public function view()
	{
		//$this->year_month = $this->request()->param('year_month');
		$this->year_month = $this->request()->param('year_month');
         Debug::Dump($this->year_month);
    }

}

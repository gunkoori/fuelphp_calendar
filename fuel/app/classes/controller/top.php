<?php
/**
 * Fuel is a fast, lightweight, community driven PHP5 framework.
 *
 * @package    Fuel
 * @version    1.7
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2013 Fuel Development Team
 * @link       http://fuelphp.com
 */

/**
 * The Welcome Controller.
 *
 * A basic controller example.  Has examples of how to set the
 * response body and status.
 *
 * @package  app
 * @extends  Controller
 */

\Autoloader::add_class('Tool',APPPATH.'classes/tool/tool.php');
use \Model\Schedule;

class Controller_Top extends Controller
{

	/**
	 * The basic welcome message
	 *
	 * @access  public
	 * @return  Response
	 */
	public function action_index()
	{
        $tool = new Tool_Tool();
        //表示するカレンダー数
        $calendar_number = $tool->calendarNumber();
        
        //カレンダーの先頭の曜日(0〜6)
        $calendar_first_day = $tool->calendarIndex();
        
        //曜日設定
        $weekday_index = $tool->weekdaySet($calendar_first_day);
        
        //年月日情報
        list($this_year, $this_month, $prev_year, $prev_month, $next_year, $next_month) = $tool->yearMonth();
        //祝日情報
        $holidays = $tool->holidays($this_year, $this_month, $calendar_number);

        //カレンダー用年月情報
        $calendar_y_m = $tool->calYearMonth($calendar_number, $this_year, $this_month);

        //コンボボックス用年月
        $combo_y_m = $tool->comboBoxMake($this_year);

        //カレンダー
        $calendar_make = array();
        foreach ($calendar_y_m as $value) {
            array_push($calendar_make, $tool->calendar($value['calendar_y'], $value['calendar_m'], $holidays, $calendar_first_day));
        }
        
        $calendar = $tool->calendar($this_year, $this_month, $holidays, $calendar_first_day);
        
        //オークションコラム
        //$auc_columns = $tool->aucColumns();

        $schedule_get = $tool->schedulesGet($this_year, $this_month, $calendar_number);
        $start_date = $schedule_get['start_date'];
        $end_date   = $schedule_get['finish_date'];


        $schedule_data = new Model_Schedule();
        $get_schedule = $schedule_data->get_schedule($start_date, $end_date);
        
        foreach ($get_schedule as $key => $value) {
            $start_date = $tool->explode_string($value['start_date']);
            $end_date = $tool->explode_string($value['end_date']);
            $year = $start_date[0];
            $month = $start_date[1];
            $day = $start_date[2];
            $month = $tool->sprintf_str($month);
            $day = $tool->sprintf_str($day);
            $schedule[$year][$month][$day][$value['schedule_id']]['title'] = $value['schedule_title'];
            $schedule[$year][$month][$day][$value['schedule_id']]['detail'] = $value['schedule_detail'];

        }

        //viewを作成
        $view = View::forge('top/index');
        
        //viewに変数を割り当てる
        $view->set('calendar_number',$calendar_number);
        $view->set('calendar_first_day',$calendar_first_day);
        $view->set('weekday_index',$weekday_index);
        $view->set('this_year',$this_year);
        $view->set('this_month',$this_month);
        $view->set('prev_year',$prev_year);
        $view->set('prev_month',$prev_month);
        $view->set('next_year',$next_year);
        $view->set('next_month',$next_month);
        $view->set('holidays',$holidays);
        $view->set('calendar_y_m',$calendar_y_m);
        $view->set('combo_y_m',$combo_y_m);
        $view->set('calendar_make',$calendar_make);
        $view->set('calendar',$calendar);
        $view->set('schedule',$schedule);
        return $view;
	}

}

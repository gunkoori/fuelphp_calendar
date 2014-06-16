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
        $auc_columns = $tool->aucColumns();

        //開始日と終了日
        $schedule_get = $tool->schedulesGet($this_year, $this_month, $calendar_number);
        $start_date = $schedule_get['start_date'];
        $end_date   = $schedule_get['finish_date'];

        //DBに登録した予定取得
        $model_schedule = new Model_Schedule();
        $get_schedule = $model_schedule->get_schedule($start_date, $end_date);

        $schedule = null;
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


        $post_data = Input::post();
        $start_day = isset($post_data['start_date']) ? $post_data['start_date']:null;//2014-04-01
        $end_day = isset($post_data['end_date']) ? $post_data['end_date']:null;//2014-04-01
        $schedule_title = isset($post_data['schedule_title']) ? $post_data['schedule_title']:null;
        $schedule_detail = isset($post_data['schedule_detail']) ? $post_data['schedule_detail']:null;

        if (isset($post_data)) {
            if(isset($post_data['start_date']) && isset($post_data['end_date']) && isset($post_data['schedule_title']) && isset($post_data['schedule_detail'])) {
                $start_day = $post_data['start_date'];
                $end_day = $post_data['end_date'];
                $schedule_title = $post_data['schedule_title'];
                $schedule_detail = $post_data['schedule_detail'];
                $insert = $model_schedule->insert($start_day, $end_day, $schedule_title, $schedule_detail);
            }
        }
        var_dump($post_data);

        //$get_parameter = Input::get('year_month');
        //if (isset($get_parameter)) {
            //$url_get = explode('-', $get_parameter);
            //$view = View::forge('top/index', $url_get);
            //$view = View::forge("top/index/$url_get[0]/$url_get[1]");
            //$view = new View();
            //$view = View::forge();
            //$view->set_filename("top/index/$url_get[0]/$url_get[1]");
            //$view->set_filename("top/index/$get_parameter");
        //}
        //else {
            //viewを作成
            $view = View::forge('top/index');
        //}

        //$this->template->content = View::forge('content');
        //$view = $this->template->content;

        //viewに変数を割り当てる
        $view->set('calendar_number',$calendar_number);
        $view->set('calendar_first_day',$calendar_first_day);
        $view->set('weekday_index',$weekday_index);
        $view->set('this_year',$this_year);
        $view->set('this_month',$this_month);
        $view->SET('prev_year',$prev_year);
        $view->set('prev_month',$prev_month);
        $view->set('next_year',$next_year);
        $view->set('next_month',$next_month);
        $view->set('holidays',$holidays);
        $view->set('calendar_y_m',$calendar_y_m);
        $view->set('combo_y_m',$combo_y_m);
        $view->set('calendar_make',$calendar_make);
        $view->set('auc_columns',$auc_columns);
        $view->set('calendar',$calendar);
        $view->set('schedule',$schedule);

        return $view;
    }

    public function action_ym()
    {
        $get_parameter = Input::post('year_month');
        Response::redirect('ym/'.$get_parameter, 'refresh');
    }

    public function action_session_check()
    {
        session_start();
        // $session_token = hash('sha256', session_id());
        //$session_token = openssl_random_pseudo_bytes(16);
        $session_token = md5(uniqid(rand(), true));
        $_SESSION['nk_token'] = $session_token;
        return $session_token;
    }


}

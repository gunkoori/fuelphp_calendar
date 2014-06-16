<?php
return array(
	//'_root_'  => 'welcome/index',  // The default route
	'_404_'   => 'welcome/404',    // The main 404 route
	
	'hello(/:name)?' => array('welcome/hello', 'name' => 'hoge'),

    '_root_' => 'top/index',

    //'top/(:num)/(:num)?' => array('top/index', 'year_month' => "$1-$2"),
    //'top/:year_month' => array('top/index', 'year_month' => "$1"),


    //'top/(:num)?' => 'top/index'
);

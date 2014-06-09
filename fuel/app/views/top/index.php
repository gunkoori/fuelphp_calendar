<!DOCTYPE html>
<html lang='ja'>
<head>
    <meta charset='utf-8'>
    <title>calendar</title>
    <?php echo Asset::css('style.css');?>
    <?php echo Asset::js('jquery-2.1.1.min.js');?>
    <?php echo Asset::js('script.js');?>
    
</head>
<body>



<div align='center'>
    <h1>かれんだーだよ！</h1>
    <a href="?year_month=<?php echo $prev_year.'-'.$prev_month; ?>">次月</a>
    <a href="?year_month=<?php echo date('Y-n'); ?>">今月</a>
    <a href="?year_month=<?php echo $next_year.'-'.$next_month; ?>">次月</a>
    <form action='' method='get'>
        <select name='year_month'>
            <?php foreach ($combo_y_m as $value):?>
                <?php if ($value['year'] == $this_year && $value['month'] == $this_month):?>
                    <option value="<?php echo $value['year'].'-'.$value['month'];?>" selected><?php echo $value['year'].'年'.$value['month'].'月'?></option>
                <?php else:?>
                    <option value="<?php echo $value['year'].'-'.$value['month'];?>"><?php echo $value['year'].'年'.$value['month'].'月';?></option>
                <?php endif;?>
            <?php endforeach;?>
        </select>
        <input type = 'submit' value = '更新'>
    </form>
</div>
<?php foreach ($calendar_make as $value) :?>
    <?php
        $week  = $value['week'];
        $year  = $value['year'];
        $month = $value['month'];
        //$weekday = $value['weekday'];
        $day_class = $value['day_class'];
    ?>
    <table class="calendar">
        <thead>
            <tr>
                <th id="test" colspan='7'><?php echo $year.'年'.$month.'月' ;?></th>
            </tr>
        </thead>
        <tbody>

        <!-- 曜日情報 -->
            <tr>
            <?php foreach ($weekday_index as $value) :?>
                <td style='height: 20px'> <?php echo $value;?> </td>
            <?php endforeach ?>
            </tr>
            <?php for ($j = 0; $j < count($week[$year][$month]); $j ++):?>
            <tr>
                <?php for ($i = 0; $i <= 6; $i++):?>
                    <?php $day = $week[$year][$month][$j][$i]['d'];?>
                    <td class="<?php if (isset($day_class[$year][$month][$j][$i]['weekday_index'])) { echo $day_class[$year][$month][$j][$i]['weekday_index']; };?>">


                        <!-- 日付情報 -->
                        <div class="<?php if(isset($day_class[$year][$month][$j][$i]['Today'])) { echo $day_class[$year][$month][$j][$i]['Today']; }?>" onmouseover="this.style.backgroundColor='orange'" onmouseout="this.style.backgroundColor=''">
                            <?php if (isset($day) == false) :?>
                                <?php echo '';?>
                            <?php else :?>
                                 <div class="day" data-dateinfo="<?php echo $week[$year][$month][$j][$i]['y'].'-'.$week[$year][$month][$j][$i]['m'].'-'.$day ;?>"><?php echo $day;?></div>
                            <?php endif ?>
                        </div>


                        <!-- 祝日情報 -->
                        <div class="holiday_info">
                            <?php if(isset($holidays[$year][$month][$day])) { echo $holidays[$year][$month][$day]; }?>
                        </div>



                        <!-- オークションコラム -->
                        <div class="auc_columns_info">
                            <?php if (isset($auc_columns[$year][$month][$day])):?> 
                                <?php foreach ($auc_columns[$year][$month][$day] as $value) :?>
                                    <a href=" <?php echo $value['link'];?> " title = '<?php echo $value['title'];?>' >
                                        <?php echo $value['title'];?>
                                    </a><br>
                                <?php endforeach;?>
                            <?php endif;?>
                        </div>

                        <!-- 予定の表示 -->
                        <div class="schedule_info">
                            <?php if (isset($schedule[$year][$month][$day])) :?> 
                                <?php foreach ($schedule[$year][$month][$day] as $key => $value) :?> 
                                    <div class="calendar_schedule" data-scheduleid="<?php echo $key ;?>" onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration=''">
                                        <?php echo $value['title'];?>
                                    </div>
                                <?php endforeach;?>
                            <?php endif;?>
                        </div>

                    </td>
                <?php endfor;?>
            </tr>
            <?php endfor;?>

        </tbody>
    </table>
<?php endforeach ;?>


</body>
</html>

<?php
    date_default_timezone_set("Asia/Taipei");
    $day=1;
    $date=date("Y-m-d H:i:s");
    echo "\$date ="; print_r($date); echo "<br>";
                                                
    // 加一天
    $date=strtotime("+$day day",strtotime($date));
    $date=date("Y-m-d H:i:s",$date);

    // 减一秒
    $date=strtotime("-1 second",strtotime($date));
    $date=date("Y-m-d H:i:s",$date);
    echo "\$date ="; print_r($date); echo "<br>";
?>
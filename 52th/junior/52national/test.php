<?php
    include("link.php");
    $row=fetchall(query("SELECT*FROM `comp`"));
    $ingame=fetchall(query("SELECT*FROM `comp` WHERE `team`!=''"));
    $notingame=fetchall(query("SELECT*FROM `comp` WHERE `team`=''"));
    $count=(int)(count($row)/2);
    $range=range(1,$count);
    for($i=0;$i<$count;$i=$i+1){
        for($j=0;$j<count($ingame);$j=$j+1){
            if($range[$i]==$ingame[$j][5]){
                unset($range[$i]);
                break;
            }
        }
    }
    if(!empty($notingame)){
        $rand=array_rand($notingame,2);
        print_r($rand);
    }
    print_r($range);
?>
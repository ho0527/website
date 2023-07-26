<?php
    include("../link.php");
    $data=json_decode(file_get_contents("php://input"),true); // [code,traintype,week,starttime,stationcount,station,arrivetime,stoptime]
    $code=$data[0];
    $traintype=$data[1];
    $week=$data[2];
    $starttime=$data[3];
    $stationcount=$data[4];
    query($db,"INSERT INTO `train`(`traintypeid`,`code`,`week`,`starttime`)VALUES(?,?,?,?)",[$traintype,$code,$week,$starttime]);
    $id=$db->lastInsertId();
    for($i=0;$i<$stationcount;$i=$i+1){
        query($db,"INSERT INTO `stop`(`trainid`,`stationid`,`arrivetime`,`stoptime`)VALUES(?,?,?,?)",[$id,$data[5][$i],$data[6][$i],$data[7][$i]]);
    }
?>
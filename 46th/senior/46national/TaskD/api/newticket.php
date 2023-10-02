<?php
    include("../link.php");
    $trainid=$_POST["trainid"];
    $typeid=$_POST["typeid"];
    $startstationid=$_POST["startstationid"];
    $endstationid=$_POST["endstationid"];
    $code=$_POST["code"];
    $phone=$_POST["phone"];
    $count=(int)$_POST["count"];
    $statu=$_POST["statu"];
    $getgodate=$_POST["getgodate"];
    query($db,"INSERT INTO `ticket`(`trainid`,`typeid`,`startstationid`,`endstationid`,`code`,`phone`,`count`,`statu`,`createdate`,`getgodate`)VALUES(?,?,?,?,?,?,?,?,?,?)",[$trainid,$typeid,$startstationid,$endstationid,$code,$phone,$count,$statu,$time,$getgodate]);

    $startstation=query($db,"SELECT*FROM `station` WHERE `id`='$startstationid'")[0][2];
    $endstation=query($db,"SELECT*FROM `station` WHERE `id`='$endstationid'")[0][2];
    $startstop=query($db,"SELECT*FROM `stop` WHERE `stationid`='$startstationid'")[0];
    $endstop=query($db,"SELECT*FROM `stop` WHERE `stationid`='$endstationid'")[0];
    $traincode=query($db,"SELECT*FROM `train` WHERE `id`='$trainid'")[0][2];
    $stop=query($db,"SELECT*FROM `stop` WHERE ?<=`id`AND`id`<=?",[$startstop[0],$endstop[0]]);

    $price=0;
    for($i=0;$i<count($stop);$i=$i+1){
        $price=$price+(int)$stop[$i][3];
    }
    $total=$count*($price);
    // 簡訊部分(未完成)
    $file=fopen("../SMS/".$phone.".txt","a");
    fwrite($file,"========================================\n列車訂位成功。訂票編號: ".$code."，".$getgodate."，".$startstation."站 到 ".$endstation."站 ".$traincode."車次\n".$count."張票，".$startstop[4]."開，共".$total."元\n");
    fclose($file);

    // 輸出
    echo(json_encode([
        "success"=>true,
        "data"=>"
            <h1>訂票成功</h1>
            <hr>
            <div class='ticketlist'>
                詳細資料如下:<br>
                訂票編號: $code<br>
                手機號碼: $phone<br>
                發車時間: $startstop[4]<br>
                車次代碼: $trainid<br>
                起程站: $startstation<br>
                終點站: $endstation<br>
                張數: $count<br>
                票價: $price<br>
                總價: $total<br>
            </div>
            <input type='button' class='button' onclick='location.reload()' value='返回'>
        "
    ]));
?>
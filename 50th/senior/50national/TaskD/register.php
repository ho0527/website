<?php
    include("link.php");
    if(isset($_GET["getrank"])){
        $row=query($db,"SELECT*FROM `rank`"); // 比對排行榜
        $data=$row;
        $check=-1;
        $id="";
        usort($data,function($a,$b){
            if($a[3]<$b[3]){
                return 1;
            }
        });
        echo(json_encode([
            "success"=>true,
            "data"=>[
                "data"=>$data
            ]
        ])); // 回傳資料
    }else{
        $data=json_decode(file_get_contents("php://input"),true); // 拿到分數等等的資料
        /*
            架構為:
            ["時間","分數","名稱"]
        */
    
        query($db,"INSERT INTO `rank`(`username`,`time`,`score`,`difficulty`,`createtime`)VALUES(?,?,?,?,?)",[$data["name"],$data["time"],$data["score"],$data["difficulty"],$time]); // 先將資料放入log

        $row=query($db,"SELECT*FROM `rank` WHERE `difficulty`=?",[$data["difficulty"]]); // 比對排行榜
        $data=$row;
        $check=-1;
        $id="";
        usort($data,function($a,$b){
            if($a[3]<$b[3]||($a[3]==$b[3]&&$a[2]>$b[2])){
                return 1;
            }
        });
        echo(json_encode([
            "success"=>true,
            "data"=>[
                "data"=>$data,
                "userid"=>$row[count($row)-1][0]
            ]
        ])); // 回傳資料
    }
?>
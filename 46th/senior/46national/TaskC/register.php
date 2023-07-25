<?php
    include("link.php");

    $data=json_decode(file_get_contents("php://input"),true); // 拿到分數等等的資料
    /*
        架構為:
        ["時間","分數","名稱"]
    */

    query($db,"INSERT INTO `log`(`name`,`score`,`playtime`,`starttime`)VALUES(?,?,?,?)",[$data[0],$data[1],$data[2],$time]); // 先將資料放入log
    $row=query($db,"SELECT*FROM `rank`"); // 比對排行榜
    $check=-1;
    $id="";
    for($i=0;$i<count($row);$i=$i+1){ // 找每一筆資料
        if($data[2]==$row[$i][1]){ // 是否存在在排行榜上?
            if($data[1]>$row[$i][2]){ // 是否大於原分數?
                $check=1; // 將check設1
                $id=$row[$i][0]; // 設定id(等等會用到)
                break;
            }elseif($data[1]==$row[$i][2]){ // 是否等於原分數?
                if($data[0]<=$row[$i][3]){ // 時間是否比較快
                    $check=1; // 將check設1
                    $id=$row[$i][0]; // 設定id(等等會用到)
                    break;
                }else{
                    $check=0; // 將check設0
                    break;
                }
            }else{
                $check=0; // 將check設0
                break;
            }
        }
    }

    if($check==1){ // check 如果是1 就要交換
        query($db,"UPDATE `log` SET `name`=?,`score`=?,`playtime`=?,`starttime`=? WHERE `id`='$id'",[$data[0],$data[1],$data[2],$time]);
    }elseif($check==-1){ // check 如果是-1 就要新增
        query($db,"INSERT INTO `rank`(`name`,`score`,`playtime`,`starttime`)VALUES(?,?,?,?)",[$data[0],$data[1],$data[2],$time]);
    }else{ echo("變爛摟XD"); } // 變爛搂

    echo(json_encode($row)); // 回傳資料
?>
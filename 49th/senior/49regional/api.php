<?php
    include("link.php");
    if(isset($_GET["login"])){
        if($_GET["login"]){
            query($db,"INSERT INTO `data`(`number`,`move1`,`move2`,`movetime`)VALUES(?,'登入','成功','$time')",[$_GET["userid"]]);
            session_unset();
            $_SESSION["data"]=$_GET["userid"];
            $_SESSION["permission"]=$row[5];
        }else{
            query($db,"INSERT INTO `data`(`number`,`move1`,`move2`,`movetime`)VALUES(?,'登入','失敗','$time')",[$_GET["userid"]]);
            session_unset();
        }
    }

    if(isset($_GET["product"])){
        $data=query($db,"SELECT*FROM `product`");
        if(isset($_GET["id"])){
            $data=query($db,"SELECT*FROM `product` WHERE `id`=?",[$_GET["id"]]);
        }
        echo(json_encode([
            "success"=>true,
            "data"=>$data
        ]));
    }
?>
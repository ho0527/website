<?php
    if(isset($_GET["login"])){
        if($_GET["login"]){
            query($db,"INSERT INTO `data`(`number`,`move1`,`move2`,`movetime`)VALUES('$row[1]','登入','成功','$time')");
            session_unset();
            $_SESSION["data"]=$row[1];
            $_SESSION["permission"]=$row[5];
            $_SESSION["timer"]=60;
        }else{
            query($db,"INSERT INTO `data`(`number`,`move1`,`move2`,`movetime`)VALUES('$row[1]','登入','失敗','$time')");
            session_unset();
        }
    }
?>
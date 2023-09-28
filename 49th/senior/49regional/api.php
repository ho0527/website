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
?>
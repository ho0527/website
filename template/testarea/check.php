<?php
    session_start();
    $username="hiiamchris";
    $password="1234567890";
    if(isset($_GET["username"])&&isset($_GET["password"])){
        if($_GET["username"]==$username){
            if($_GET["password"]==$password){
                $_SESSION["ok"]=true;
                header("location:main.php");
            }else{
                $_SESSION["msg"]="密碼錯誤";
                header("location:index.php");
            }
        }else{
            $_SESSION["msg"]="帳號錯誤";
            header("location:index.php");
        }
    }else{
        header("location:index.php");
    }
?>
<?php
    $conn=new PDO("mysql:host=localhost;dbname=user;charset=utf8","admin","1234");
    date_default_timezone_set("Asia/Taipei");
    $time=date("Y-m-d H:i:s");
    session_start();

    function query($query){
        global $conn;
        return $conn->query($query);
    }

    function fetch($result){
        return $result->fetch();
    }

    function fetchall($result){
        return $result->fetchAll();
    }

    function rowcount($result){
        return $result->rowCount();
    }
?>
<?php
    $db=new PDO("mysql:host=localhost;dbname=module2;charset=utf8","admin","1234");
    date_default_timezone_set("Asia/Taipei");
    $date=date("Y-m-d H:i:s");
    session_start();

    function query($query){
        global $db;
        return $db->query($query);
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
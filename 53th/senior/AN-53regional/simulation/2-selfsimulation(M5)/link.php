<?php
    $db=new PDO("mysql:host=localhost;dbname=53regional;charset=utf8","admin","1234");
    date_default_timezone_set("Asia/Taipei");
    $time=date("Y-m-d H:i:s");
    session_start();

    function query($db,$data){
        return $db->query($data);
    }

    function fetch($data){
        return $data->fetch();
    }

    function fetchall($data){
        return $data->fetchall();
    }

    if(isset($_GET["logout"])){
        @$data=$_SESSION["data"];
        $row=fetch(query($db,"SELECT*FROM `user` WHERE `number`='$data'"));
        if(isset($data)){
            query($db,"INSERT INTO `data`(`number`, `username`, `password`,`name`,`permission`, `time`, `move`) VALUES ('$row[4]','$row[1]','$row[2]','$row[3]','$row[5]','$time','登出成功')");
            session_unset();
            ?><script>alert("登出成功!");location.href="index.php"</script><?php
        }else{
            query($db,"INSERT INTO `data`(`number`, `username`, `password`,`name`,`permission`, `time`, `move`) VALUES ('未知','',']','','','$time','登出成功')");
            session_unset();
            ?><script>alert("登出成功!");location.href="index.php"</script><?php
        }
    }
?>
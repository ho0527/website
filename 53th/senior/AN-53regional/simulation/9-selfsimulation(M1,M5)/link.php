<?php
    $db=new PDO("mysql:host=localhost;dbname=db06;charset=utf8","admin","1234");
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
        $data=$_SESSION["data"];
        if($row=fetch(query($db,"SELECT*FROM `user` WHERE `number`='$data'"))){
            query($db,"INSERT INTO `data`(`number`, `username`, `code`, `name`, `permission`, `move`, `movertime`) VALUES ('$row[1]','$row[2]','$row[3]','$row[4]','$row[5]','登出成功','$time')");
        }else{
            query($db,"INSERT INTO `data`(`number`, `username`, `code`, `name`, `permission`, `move`, `movertime`) VALUES ('未知','','','','','登出成功','$time')");
        }
        session_unset();
        ?><script>alert("登出成功");location.href="admin.php"</script><?php
    }

?>
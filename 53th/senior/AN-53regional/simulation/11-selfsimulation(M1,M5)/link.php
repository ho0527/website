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
            query($db,"INSERT INTO `data`(`number`, `username`, `code`, `name`, `permission`, `move`, `movetime`)VALUES('$row[1]','$row[2]','$row[3]','$row[4]','$row[5]','登出成功','$time')");
            session_unset();
            ?><script>alert("登出成功");location.href="index.php"</script><?php
        }else{
            query($db,"INSERT INTO `data`(`number`, `username`, `code`, `name`, `permission`, `move`, `movetime`)VALUES('未知','','','','','登出成功','$time')");
            session_unset();
            ?><script>alert("登出成功");location.href="index.php"</script><?php
        }
    }

    function data($a,$i,$p){

    }

    function product($a,$db,$pr){
        $product=fetchall(query($db,"SELECT*FROM `product`"));
        usort($a,function($a,$b){ return $a[0]>$b[0]; });
        for($i=0;$i<count($a);$i++){
            if($pr==0){
                
            }
        }
    }
?>
<?php
    $db=new PDO("mysql:host=localhost;dbname=49regional;charset=utf8","admin","1234");
    date_default_timezone_set("Asia/Taipei");
    $time=date("Y-m-d H:i:s");
    session_start();

    function query($db,$query){
        $prepare=$db->prepare($query);
        $prepare->execute();
        return $prepare->fetchAll();
    }

    if(isset($_GET["logout"])){
        @$data=$_SESSION["data"];
        $row=query($db,"SELECT*FROM `user` WHERE `number`='$data'");
        if($row){
            $row=$row[0];
            query($db,"INSERT INTO `data`(`number`,`move1`,`move2`,`movetime`)VALUES('$row[1]','登出','成功','$time')");
        }else{
            query($db,"INSERT INTO `data`(`number`,`move1`,`move2`,`movetime`)VALUES('未知','登出','成功','$time')");
        }
        session_unset();
        ?><script>alert("登出成功!");location.href="index.php"</script><?php
    }
?>
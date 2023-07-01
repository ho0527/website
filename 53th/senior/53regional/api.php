<?php
    include("link.php");

    if(isset($_GET["logout"])){
        $data=$_SESSION["data"];
        if(isset($data)){
            $row=query($db,"SELECT*FROM `user` WHERE `number`='$data'")[0];
            echo "\$data ="; print_r($data); echo "<br>";
            query($db,"INSERT INTO `data`(`number`,`username`,`password`,`name`,`permission`,`move1`,`move2`,`movetime`)VALUES(?,?,?,?,?,'登出','成功',?)",[$row[4],$row[1],$row[2],$row[3],$row[5],$time]);
            session_unset();
            ?><script>alert("登出成功!");location.href="index.php"</script><?php
        }else{
            query($db,"INSERT INTO `data`(`number`,`username`,`password`,`name`,`permission`,`move1`,`move2`,`movetime`)VALUES('未知','','','','','登出','成功','$time')");
            session_unset();
            ?><script>alert("登出成功!");location.href="index.php"</script><?php
        }
    }
?>
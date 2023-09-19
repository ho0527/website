<?php
    if(isset($_GET["logout"])){
        @$data=$_SESSION["data"];
        $row=fetch(query($db,"SELECT*FROM `user` WHERE `number`='$data'"));
        if($row){
            query($db,"INSERT INTO `data`(`number`,`move1`,`move2`,`movetime`)VALUES('$row[1]','登出','成功','$time')");
        }else{
            query($db,"INSERT INTO `data`(`number`,`move1`,`move2`,`movetime`)VALUES('未知','登出','成功','$time')");
        }
        session_unset();
        ?><script>alert("登出成功!");location.href="index.php"</script><?php
    }
?>
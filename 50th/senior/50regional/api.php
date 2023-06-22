<?php
    include("link.php");
    $data=$_SESSION["data"];

    if(isset($_GET["logout"])){
        query($db,"INSERT INTO `log`(`username`,`move`,`movetime`,`ps`)VALUES('$data','登出系統','$time','')");
        session_unset();
        ?><script>alert("登出成功");location.href="index.php"</script><?php
    }
?>
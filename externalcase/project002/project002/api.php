<?php
    include("link.php");

    if(isset($_GET["logout"])){
        $data=$_SESSION["data"];
        query($db,"INSERT INTO `log`(`username`,`move`,`movetime`)VALUES(?,'登入系統','$time')",[$data]);
        session_unset();
        ?><script>alert("登出成功");location.href="index.php"</script><?php
    }
?>
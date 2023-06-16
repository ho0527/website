<?php
    include("link.php");

    if(isset($_GET["logout"])){
        session_unset();
        ?><script>alert("登出成功");location.href="index.php"</script><?php
    }
?>
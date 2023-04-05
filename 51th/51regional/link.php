<?php
    $db=new PDO("mysql:host=localhost;dbname=web6;charset=utf8","admin","1234");
    date_default_timezone_set("Asia/Taipei");
    $time=date("Y-m-d H:i:s");
    session_start();

    function query($db,$query){
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

    if(isset($_GET["logout"])){
        session_unset();
        ?><script>alert("登出成功");location.href="index.php"</script><?php
    }
?>
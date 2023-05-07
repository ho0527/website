<?php
    $db=new PDO("mysql:host=localhost;dbname=51regional;charset=utf8","root","");
    date_default_timezone_set("Asia/Taipei");
    $time=date("Y-m-d H:i:s");
    session_start();

    function query($db,$query,$data=[]){
       $prepare=$db->prepare($query);
       $prepare->execute($data);
       return $prepare->fetchAll();
    }

    // function query($db,$query){
    //     return $db->query($query);
    // }

    // function fetch($result){
    //     return $result->fetch();
    // }

    // function fetchall($result){
    //     return $result->fetchAll();
    // }

    // function rowcount($result){
    //     return $result->rowCount();
    // }

    if(isset($_GET["logout"])){
        session_unset();
        ?><script>alert("登出成功");location.href="index.php"</script><?php
    }

    if(isset($_GET["formdel"])){
        $id=$_GET["id"];
        query($db,"UPDATE `question` SET `ps`='del' WHERE `id`='$id'");
        ?><script>location.href="admin.php"</script><?php
    }
?>
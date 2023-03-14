<?php
    $db=new PDO("mysql:host=localhost;dbname=49regional;charset=utf8","admin","1234");
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

    function block($name){
        return preg_match("/([ ,\!,\@,\#,\$,\%,\^,\&,\*,\(,\),\_,\-,\+,\=,\{,\},\[,\],\|,\\\,\:,\;,\',\",\<,\>,\,,\.,\?,\/ ])/",$name,$e);
    }

    if(isset($_GET["logout"])){
        @$data=$_SESSION["data"];
        $row=fetch(query($db,"SELECT*FROM `user` WHERE `number`='$data'"));
        if(isset($data)){
            query($db,"INSERT INTO `data`(`number`,`move`,`movetime`)VALUES('$row[1]','$time','登出成功')");
        }else{
            query($db,"INSERT INTO `data`(`number`,`move`,`movetime`)VALUES('未知','$time','登出成功')");
        }
        session_unset();
        ?><script>alert("登出成功!");location.href="index.php"</script><?php
    }



?>
<?php
    $db=new PDO("mysql:host=localhost;dbname=52nationaltaskdnoapi;charset=utf8","admin","1234");
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

    function block($name){
        return preg_match("/([ ,\!,\@,\#,\$,\%,\^,\&,\*,\(,\),\_,\-,\+,\=,\{,\},\[,\],\|,\\\,\:,\;,\",\',\<,\>,\,,\.,\?,\/ ])/",$name);
    }

    if(isset($_GET["logout"])){
        $data=$_SESSION["data"];
        query($db,"UPDATE `user` SET `token`='' WHERE `id`='$data'");
        session_unset();
        ?><script>alert("登出成功");location.href="index.php"</script><?php
    }
?>
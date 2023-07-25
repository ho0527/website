<?php
    include("../link.php");
    if(isset($_POST["submit"])){
        $name=$_POST["name"];
        $passenger=$_POST["passenger"];
        if(!query($db,"SELECT*FROM `type` WHERE `name`=?",[$name])){
            if(preg_match("/^[0-9]+$/",$passenger)){
                query($db,"INSERT INTO `type`(`name`,`passenger`)VALUES(?,?)",[$name,$passenger]);
                ?><script>alert("成功");location.href="../admintype.html"</script><?php
            }else{
                ?><script>alert("乘載量必須為整數");location.href="../admintype.html"</script><?php
            }
        }else{
            ?><script>alert("車種已存在");location.href="../admintype.html"</script><?php
        }
    }
?>
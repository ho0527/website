<?php
    include("../link.php");
    if(isset($_POST["submit"])){
        $id=$_POST["id"];
        $name=$_POST["name"];
        $passenger=$_POST["passenger"];
        $row=query($db,"SELECT*FROM `type` WHERE `name`=?",[$name])[0];
        if(!$row||$row[0]==$id){
            if(preg_match("/^[0-9]+$/",$passenger)){
                query($db,"UPDATE `type` SET `name`=?,`passenger`=? WHERE `id`=?",[$name,$passenger,$id]);
                ?><script>alert("成功");location.href="../admintype.html"</script><?php
            }else{
                ?><script>alert("乘載量必須為整數");location.href="../admintype.html"</script><?php
            }
        }else{
            ?><script>alert("車種已存在");location.href="../admintype.html"</script><?php
        }
    }
?>
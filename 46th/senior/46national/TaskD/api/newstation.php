<?php
    include("../link.php");
    if(isset($_POST["submit"])){
        $name=$_POST["name"];
        $englishname=$_POST["englishname"];
        if(!query($db,"SELECT*FROM `station` WHERE `englishname`=?OR`name`=?",[$englishname,$name])){
            query($db,"INSERT INTO `station`(`englishname`,`name`)VALUES(?,?)",[$englishname,$name]);
            ?><script>alert("成功");location.href="../adminstation.html"</script><?php
        }else{
            ?><script>alert("站點已存在");location.href="../adminstation.html"</script><?php
        }
    }
?>
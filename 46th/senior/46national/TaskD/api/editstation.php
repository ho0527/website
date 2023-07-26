<?php
    include("../link.php");
    if(isset($_POST["submit"])){
        $id=$_POST["id"];
        $name=$_POST["name"];
        $englishname=$_POST["englishname"];
        $row=query($db,"SELECT*FROM `station` WHERE `englishname`=?OR`name`=?",[$englishname,$name])[0];
        if(!$row||$row[0]==$id){
            query($db,"UPDATE `station` SET `englishname`=?,`name`=? WHERE `id`=?",[$englishname,$name,$id]);
            ?><script>alert("成功");location.href="../adminstation.html"</script><?php
        }else{
            ?><script>alert("站點已存在");location.href="../adminstation.html"</script><?php
        }
    }
?>
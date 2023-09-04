<?php
    header("location:../login.html");
    include("../link.php");
    for($i=0;$i<35;$i=$i+1){
        $name="";
        query($db,"INSERT INTO `classmate`(`name`)VALUES(?)",[$name]);
    }
?>
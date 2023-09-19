<?php
    include("../link.php");
    if(isset($_POST["submit"])){
        for($i=1;$i<=35;$i=$i+1){
            query($db,"INSERT INTO `score`(`classmateid`,`title`,`score`,`ps`)VALUES(?,?,?,?)",[$i,$_POST["title"],$_POST[$i],""]);
        }
        ?><script>alert("新增成功");location.href="../admin.html"</script><?php
    }else{
        ?><script>location.href="../login.html"</script><?php
    }
?>
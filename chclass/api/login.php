<?php
    include("../link.php");
    if(isset($_POST["submit"])){
        $username=$_POST["username"];
        $password=$_POST["password"];
        if($row=query($db,"SELECT*FROM `user` WHERE `username`=?",[$username])[0]){
            if($row[2]==$password){
                query($db,"INSERT INTO `log`(`userid`, `move`, `movetime`, `ps`)VALUES(?,?,?,?)",[$row[0],"登入成功",$time,""]);
                session_unset();
                $_SESSION["data"]=$row[0];
                if($row[0]==1||$row[0]==2||$row[0]==3){
                    ?><script>alert("登入成功");location.href="../admin.html"</script><?php
                }else{
                    ?><script>alert("登入成功");location.href="../user.html"</script><?php
                }
            }else{
                query($db,"INSERT INTO `log`(`userid`, `move`, `movetime`, `ps`)VALUES(?,?,?,?)",[$row[0],"登入失敗(密碼錯誤)",$time,""]);
                ?><script>alert("密碼有誤");location.href="../login.html"</script><?php
            }
        }else{
            query($db,"INSERT INTO `log`(`userid`, `move`, `movetime`, `ps`)VALUES(?,?,?,?)",["未知","登入失敗(帳號錯誤)",$time,""]);
            ?><script>alert("帳號有誤");location.href="../login.html"</script><?php
        }
    }
?>
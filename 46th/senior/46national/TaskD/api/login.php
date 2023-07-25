<?php
    include("../link.php");
    if(isset($_POST["submit"])){
        $username=$_POST["username"];
        $password=$_POST["password"];
        if($row=query($db,"SELECT*FROM `user` WHERE `username`=?",[$username])[0]){
            if($row[2]==$password){
                $_SESSION["data"]=$row[0];
                ?><script>alert("登入成功");location.href="../admin.html"</script><?php
            }else{
                ?><script>alert("密碼有誤");location.href="../login.html"</script><?php
            }
        }else{
            ?><script>alert("帳號有誤");location.href="../login.html"</script><?php
        }
    }
?>
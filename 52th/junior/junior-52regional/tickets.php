<?php
    $db=new mysqli("localhost","root","","web3");
    if(isset($_GET["submit"])){
        $firstname=$_GET["firstname"];
        $lastname=$_GET["lastname"];
        $phone=$_GET["phone"];
        $password=$_GET["password"];
        $verification=$_GET["verification"];
        $ans=$_GET["ans"];
        if($verification==$ans){
            mysqli_query($db,"INSERT INTO `52j17`(`firstname`, `lastname`, `phone`, `password`) VALUES('$firstname','$lastname','$phone','$password')");
            ?><script>alert("新增成功");location.href="home.html"</script><?php
            session_unset();
        }else{
            ?><script>alert("驗證碼輸入錯誤");location.href="tickets.html"</script><?php
        }
    }else{
        header("location:tickets.html");
    }
?>
<head>
    <meta charset="UTF-8">
    <title>WTF IS THIS</title>
    <script src="index.js"></script>
    <link rel="stylesheet" href="index.css">
</head>
<div class="border">
    <div class="coffee_border">
        <h1 class="coffee_text">
            咖啡展示系統
        </h1>
    </div>
    <form method="post">
    <div class="account">
        <h6 class="account_text">
            帳號
        </h6>
        <input class="account_border" type="text" name="email">
    </div>
    
    <div class="password">
        <h6 class="password_text">
            密碼
        </h6>
        <input class="password_border" type="password" name="password">
    </div>
    
    <div class="verification">
        <div class="verification_1">
            <h6 class="verification_text_1">C</h6>
        </div>
        <div class="verification_2">
            <h6 class="verification_text_1">O</h6>
        </div>
        <div class="verification_3">
            <h6 class="verification_text_1">F</h6>
        </div>
        <div class="verification_4">
            <h6 class="verification_text_1">F</h6>
        </div>
        
        <div class="verification_reset">
            <h6 class="verification_reset_text">重新產生</h6>
        </div>
    </div>

    <div class="big_to_small_border">
        <div class="verification_1">
            <h6 class="verification_text_1"></h6>
        </div>
        <div class="verification_2">
            <h6 class="verification_text_1"></h6>
        </div>
        <div class="verification_3">
            <h6 class="verification_text_1"></h6>
        </div>
        <div class="verification_4">
            <h6 class="verification_text_1"></h6>
        </div>
    </div>
    <h6 class="verification_text">
        驗證碼
    </h6>
    <h6 class="big_to_small">
        由大到小排列
    </h6>
    
    <div class="delete">
        <h6 class="delete_text">清除</h6>
    </div>
    
    <div class="lodin_border">
        <input type="submit" value="登入" name="submit">
    </div>
    </form>
</div>
<?php
if(isset($_POST["submit"])){
    $email=$_POST["email"];
    $password=$_POST["password"];
    echo($email);
    echo($password);
    $db=new PDO("mysql:host=localhost;dbname=testt;charset=utf8","root","");
    
    $a=$db->query("SELECT * FROM `test` WHERE `username`='$email'")->fetch();
    if($a){
        if($a["password"]==$password){
            ?><script>alert("登入成功");location.href="main.html"</script><?php
        }
        else{
            ?><script>alert("密碼有誤");location.href="index.php"</script><?php
        }
    }
    else{
        ?><script>alert("帳號有誤");location.href="index.php"</script><?php
    }
}

?>
</body>
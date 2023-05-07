<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>編輯問卷</title>
        <link rel="stylesheet" href="index.css">
    </head>
    <body>
        <?php
            include("link.php");
            $id=$_SESSION["id"];
            $row=query($db,"SELECT*FROM `question` WHERE `id`='$id'")[0];
            $coderow=query($db,"SELECT*FROM `questioncode` WHERE `questionid`='$id'");
        ?>
        <form method="POST">
            <div class="navigationbar">
                <div class="navigationbartitle">網路問卷管理系統-問卷邀請碼</div><br>
                <div class="navigationbarbuttondiv">
                    <input type="submit" class="button" name="goback" value="返回">
                    <input type="submit" class="button" name="save" value="儲存">
                    <input type="button" class="button" onclick="location.href='api.php?logout='" value="登出">
                </div>
            </div>
            <div class="questioncodemaindiv">
                全體 <input type="radio" name="mod" value="all" checked>
                單一用戶 <input type="radio" name="mod" value="user"><br><br>
                <input type="text" name="code" value="<?php
                    if(isset($coderow[0][3])){ echo($coderow[0][3]); }
                ?>">
            </div>
        </form>
        <?php
            if(isset($_POST["newqust"])){
                $_SESSION["count"]=$_SESSION["count"]+1;
                ?><script>location.href="form.php"</script><?php
            }
            if(isset($_POST["save"])){
                if($_SESSION["mod"]=="user"){

                }else{
                    $code=$_POST["code"];
                    if(preg_match("/^[0-9]+$/",$code)){
                        $row=query($db,"SELECT*FROM `questioncode` WHERE `code`='$code'");
                        if(!query($db,"SELECT*FROM `questioncode` WHERE `code`='$code'")){
                            if(query($db,"SELECT*FROM `questioncode` WHERE `id`=?",[$id])[0]){
                                query($db,"UPDATE `questioncode` SET `questionid`='$id',`user`='',`code`='$code' WHERE `questionid`='$id'");
                            }else{
                                query($db,"INSERT INTO `questioncode`(`questionid`,`user`,`code`)VALUES('$id','','$code')");
                            }
                            ?><script>alert("儲存成功");location.href="form.php"</script><?php
                        }else{
                            ?><script>alert("邀請碼已存在");location.href="questioncode.php"</script><?php
                        }
                    }else{
                        ?><script>alert("邀請碼只能輸入數字");location.href="questioncode.php"</script><?php
                    }
                }
            }
            if(isset($_POST["goback"])){
                ?><script>location.href="form.php?id=<?php echo($_SESSION["id"]) ?>"</script><?php
            }
        ?>
        <script src="questioncode.js"></script>
    </body>
</html>
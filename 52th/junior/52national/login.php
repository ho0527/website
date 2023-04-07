<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Shanghai Battle!</title>
        <link rel="stylesheet" href="index.css">
    </head>
    <body>
        <img src="banner.png" class="banner">
        <div class="navigationbar">
            <img src="logo.png" class="logo">
            <div class="navigationbarbuttondiv">
                <input type="button" class="navigationbarbutton" onclick="location.href='index.php'" value="玩家留言">
                <input type="button" class="navigationbarbutton" onclick="location.href='post.php'" value="玩家參賽">
                <input type="button" class="navigationbarbutton selectbutton" onclick="location.href='login.php'" value="網站管理">
                <input type="button" class="navigationbarbutton" onclick="location.href='link.php?logout='" value="登出">
            </div>
        </div>
        <?php
            include("link.php");
            if(isset($_SESSION["data"])){
                ?>
                <div class="loginhead">
                    <div class="center">
                        <input type="button" class="loginbutton button selectbutton" onclick="location.href='login.php'" value="留言管理">
                        <input type="button" class="loginbutton button" onclick="location.href='comp.php'" value="賽制管理">
                    </div>
                </div>
                <div class="post" id="post">
                    <div class="posthead">
                        <div class="posttitle">玩家留言列表</div>
                    </div>
                    <div class="postbody">
                        <?php
                            $a=fetchall(query("SELECT*FROM `message`"));
                            usort($a,function($a,$b){
                                return strcmp($b[8],$a[8]);
                            });
                            for($i=0;$i<sizeof($a);$i=$i+1){
                                $id=$a[$i][0]
                                ?>
                                <table class="postmessage">
                                    <tr>
                                        <td class="username" rowspan="2"><?= $a[$i][2] ?></td>
                                        <td class="message" rowspan="2"><?= $a[$i][3] ?></td>
                                        <?php
                                            if($a[$i][9]!=""){
                                                ?>
                                                <td class="pictre" rowspan="4"><img src="<?= $a[$i][9] ?>" alt="" width="75px"></td>
                                                <?php
                                            }else{
                                                ?>
                                                <td class="pictre" rowspan="4"></td>
                                                <?php
                                            }
                                            if($a[$i][11]==""){
                                                ?>
                                                <td class="edit" rowspan="4">
                                                    <form>
                                                        <button type="submit" name="edit" value="<?= $a[$i][1] ?>">編輯</button>
                                                        <button type="submit" name="del" value="<?= $a[$i][1] ?>">刪除</button>
                                                        <button type="submit" name="resp" value="<?= $a[$i][1] ?>">回應</button>
                                                        <?php
                                                        if($a[$i][13]=="yes"){
                                                            ?>
                                                            <button type="submit" name="pin" value="<?= $a[$i][1] ?>">解置頂</button>
                                                            <?php
                                                        }else{
                                                            ?>
                                                            <button type="submit" name="pin" value="<?= $a[$i][1] ?>">置頂</button>
                                                            <?php
                                                        }
                                                        ?>
                                                    </form>
                                                </td>
                                                <?php
                                            }else{
                                                ?>
                                                <td class="edit" rowspan="4">
                                                    <form>
                                                        <button type="submit" name="edit" value="<?= $a[$i][1] ?>" disabled>編輯</button>
                                                        <button type="submit" name="del" value="<?= $a[$i][1] ?>">刪除</button>
                                                        <button type="submit" name="resp" value="<?= $a[$i][1] ?>"disabled>回應</button>
                                                        <?php
                                                        if($a[$i][13]=="yes"){
                                                            ?>
                                                            <button type="submit" name="pin" value="<?= $a[$i][1] ?>">解置頂</button>
                                                            <?php
                                                        }else{
                                                            ?>
                                                            <button type="submit" name="pin" value="<?= $a[$i][1] ?>">置頂</button>
                                                            <?php
                                                        }
                                                        ?>
                                                    </form>
                                                </td>
                                                <?php
                                            }
                                        ?>
                                    </tr>
                                    <tr>
                                    </tr>
                                    <tr>
                                        <?php
                                            if($a[$i][11]!=""){
                                                ?>
                                                <td class="postdate" colspan="2">刪除於:<?= $a[$i][11] ?></td>
                                                <?php
                                            }elseif($a[$i][10]!=""){
                                                ?>
                                                <td class="postdate" colspan="2">發表於:<?= $a[$i][8] ?> 修改於:<?= $a[$i][10] ?></td>
                                                <?php
                                            }else{
                                                ?>
                                                <td class="postdate" colspan="2">發表於:<?= $a[$i][8] ?></td>
                                                <?php
                                            }
                                            ?></tr><tr><?php
                                            if($a[$i][5]=="yes"){
                                                if($a[$i][7]=="yes"){
                                                    ?>
                                                    <td class="postemail" colspan="2">E-mail:<?= $a[$i][4] ?> 電話:<?= $a[$i][6] ?></td>
                                                    <?php
                                                }else{
                                                    ?>
                                                    <td class="postemail" colspan="2">E-mail:<?= $a[$i][4] ?> 電話:未提供</td>
                                                    <?php
                                                }
                                            }else{
                                                if($a[$i][7]=="yes"){
                                                    ?>
                                                    <td class="postemail" colspan="2">E-mail:未提供 電話:<?= $a[$i][6] ?></td>
                                                    <?php
                                                }else{
                                                    ?>
                                                    <td class="postemail" colspan="2">E-mail:未提供 電話:未提供</td>
                                                    <?php
                                                }
                                            }
                                            ?></tr><tr><?php
                                            if($a[$i][12]==""){
                                                ?>
                                                <td class="adminmessage" colspan="4">管理員回應: 無</td>
                                                <?php
                                            }else{
                                                ?>
                                                <td class="adminmessage" colspan="4">管理員回應: <?= $a[$i][12] ?></td>
                                                <?php
                                            }
                                        ?>
                                    </tr>
                                </table>
                                <?php
                            }
                        ?>
                    </div>
                </div>
                <?php
                if(isset($_GET["edit"])){
                    $sn=$_GET["edit"];
                    $row=fetch(query("SELECT*FROM `message` WHERE `sn`='$sn'"))
                    ?>
                    <div class="newchatdiv" id="editchatdiv">
                        <form class="signupdiv">
                            <div class="title">玩家留言-編輯</div>
                            姓&nbsp&nbsp名: <input type="text" class="indexinput" name="username" value="<?= @$row[2] ?>"><br>
                            email: <input type="text" class="indexinput" name="email" placeholder="要有@及一個以上的." value="<?= @$row[4] ?>"> 顯示:<input type="checkbox" name="emailbox" checked><br>
                            電&nbsp&nbsp話: <input type="text" class="indexinput" name="tel" placeholder="只能包含數字或-" value="<?= @$row[6] ?>"> 顯示:<input type="checkbox" name="telbox" checked><br>
                            留言內容: <textarea name="message" rows="1" cols="25"><?= @$row[3] ?></textarea>
                            留言序號:<input type="text" name="sn" placeholder="4位數字" style="width: 50px;" value="<?= @$sn ?>" readonly>
                            <input type="submit" name="editsubmit" class="button" value="送出">
                            <input type="button" onclick="location.href='login.php'" class="button" value="返回"><br>
                        </form>
                    </div>
                    <?php
                }
                if(isset($_GET["del"])){
                    $sn=$_GET["del"];
                    query("DELETE FROM `message` WHERE `sn`='$sn'");
                    ?><script>alert("刪除成功!");location.href="login.php"</script><?php
                }
                if(isset($_GET["editsubmit"])){
                    $username=$_GET["username"];
                    $email=$_GET["email"];
                    $emailbox=$_GET["emailbox"];
                    $tel=$_GET["tel"];
                    $telbox=$_GET["telbox"];
                    $message=$_GET["message"];
                    $sn=$_GET['sn'];
                    if(!preg_match("/^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,5}$/", $email)) {
                        ?><script>alert("email驗證失敗!");location.href="login.php"</script><?php
                    }elseif(!preg_match("/^[0-9-]+$/",$tel)){
                        ?><script>alert("電話驗證失敗!");location.href="login.php"</script><?php
                    }elseif($username==""){
                        ?><script>alert("請輸入名字!");location.href="login.php"</script><?php
                    }else{
                        if(isset($emailbox)){
                            if(isset($telbox)){
                                query("UPDATE `message` SET `username`='$username',`message`='$message',`email`='$email',`emailbox`='yes',`tel`='$tel',`telbox`='yes',`edit`='$date' WHERE `sn`='$sn'");
                                ?><script>alert("更改成功!");location.href="login.php"</script><?php
                            }else{
                                query("UPDATE `message` SET `username`='$username',`message`='$message',`email`='$email',`emailbox`='yes',`tel`='$tel',`telbox`='no',`edit`='$date' WHERE `sn`='$sn'");
                                ?><script>alert("更改成功!");location.href="login.php"</script><?php
                            }
                        }else{
                            if(isset($telbox)){
                                query("UPDATE `message` SET `username`='$username',`message`='$message',`email`='$email',`emailbox`='no',`tel`='$tel',`telbox`='yes',`edit`='$date' WHERE `sn`='$sn'");
                                ?><script>alert("更改成功!");location.href="login.php"</script><?php
                            }else{
                                query("UPDATE `message` SET `username`='$username',`message`='$message',`email`='$email',`emailbox`='no',`tel`='$tel',`telbox`='no',`edit`='$date' WHERE `sn`='$sn'");
                                ?><script>alert("更改成功!");location.href="login.php"</script><?php
                            }
                        }
                    }
                }
                if(isset($_GET["logout"])){
                    if(isset($_SESSION["data"])){
                        ?><script>alert("登出成功!");location.href="login.php"</script><?php
                        session_unset();
                    }else{
                        ?><script>alert("請先登入!");location.href="login.php"</script><?php
                        session_unset();
                    }
                }
            }else{
                ?>
                <div class="main">
                    <form>
                        <div class="indextitle">網站管理-登入</div>
                        <hr>
                        帳號: <input type="text" class="input" name="username" value="<?= @$_SESSION["username"] ?>" autocomplete="off"><br><br>
                        密碼: <input type="password" class="input" name="code" value="<?= @$_SESSION["password"] ?>" autocomplete="off"><br><br>
                        驗證碼: <input type="text" class="input" name="verify" value="<?= @$_SESSION["verify"] ?>" autocomplete="off"><br><br>
                        <?php
                            $a="";
                            for($i=0;$i<4;$i=$i+1){
                                $str=range("0","9");
                                $finalStr=$str[rand(0,9)];
                                $a=$a.$finalStr;
                            }
                        ?>
                        <input type="hidden" name="verifyans" value="<?= $a ?>">
                        <div class="verifybox" id="dragbox">
                            <?php echo($a); ?>
                        </div>
                        <input type="submit" class="button" name="reflashpng" value="重新產生"><br>
                        <input type="submit" class="loginbutton button" value="清除" name="clear">
                        <input type="submit" class="loginbutton button" name="login" value="登入">
                        <?php
                            if(isset($_GET["reflashpng"])){
                                @$_SESSION["username"]=$_GET["username"];
                                @$_SESSION["password"]=$_GET["code"];
                                @$_SESSION["verify"]=$_GET["verify"];
                                header("location:login.php");
                            }
                            if(isset($_GET["clear"])){
                                session_unset();
                                header('location:login.php');
                            }
                            if(isset($_GET["login"])){
                                $username=$_GET['username'];
                                $code=$_GET['code'];
                                $_SESSION["username"]=$username;
                                $_SESSION["password"]=$code;
                                $verify=$_GET["verify"];
                                $ans=$_GET["verifyans"];
                                if(block($username)){
                                    ?><script>alert("禁止輸入特殊字元");location.href="login.php"</script><?php
                                }else{
                                    if($row=fetch(query("SELECT*FROM `user` WHERE `username`='$username'"))){
                                        if($row[2]==$code){
                                            if($ans==$verify){
                                                ?><script>alert("登入成功");location.href="login.php"</script><?php
                                                $_SESSION["data"]=$username;
                                            }else{
                                                ?><script>alert("圖形驗證碼有誤");location.href="login.php"</script><?php
                                            }
                                        }else{
                                            ?><script>alert("密碼有誤");location.href="login.php"</script><?php
                                        }
                                    }else{
                                        ?><script>alert("帳號有誤");location.href="login.php"</script><?php
                                    }
                                }
                            }
                        ?>
                    </form>
                </div>
                <?php
            }
            if(isset($_GET["pin"])){
                $sn=$_GET["pin"];
                $row=fetch(query("SELECT*FROM `message` WHERE `sn`='$sn'"));
                if($row[13]=="yes"){
                    query("UPDATE `message` SET `pin`='' WHERE `sn`='$sn'");
                    ?><script>alert("解訂成功!");location.href="login.php"</script><?php
                }else{
                    query("UPDATE `message` SET `pin`='yes' WHERE `sn`='$sn'");
                    ?><script>alert("訂選成功!");location.href="login.php"</script><?php
                }
            }
            if(isset($_GET["resp"])){
                $sn=$_GET["resp"];
                $row=fetch(query("SELECT*FROM `message` WHERE `sn`='$sn'"))
                ?>
                <div class="adminresp" id="editchatdiv">
                    <form class="signupdiv">
                        <div class="title">管理員留言</div>
                        留言內容: <textarea name="message" rows="1" cols="25"><?= @$row[12] ?></textarea><br>
                        留言序號:<input type="text" name="sn" placeholder="4位數字" style="width: 50px;" value="<?= @$sn ?>" readonly>
                        <input type="submit" name="respsubmit" class="button" value="送出">
                        <input type="button" onclick="location.href='login.php'" class="button" value="返回"><br>
                    </form>
                </div>
                <?php
            }
            if(isset($_GET["respsubmit"])){
                $message=$_GET["message"];
                $sn=$_GET['sn'];
                query("UPDATE `message` SET `respond`='$message' WHERE `sn`='$sn'");
                ?><script>alert("更改成功!");location.href="login.php"</script><?php
            }
        ?>
        <script src="index.js"></script>
    </body>
</html>
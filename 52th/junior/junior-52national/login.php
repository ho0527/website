<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Shanghai Battle!</title>
        <link rel="stylesheet" href="index.css">
    </head>
    <body>
        <img src="logo.png" class="logo">
        <div class="head">
            <form>
                <input type="button" id="index" value="玩家留言" class="indexbutton" onclick="location.href='index.php'">
                <input type="button" id="view" value="玩家參賽" class="indexbutton" onclick="location.href='post.php'">
                <input type="button" id="signup" value="網站管理" class="indexbutton selectbut" onclick="location.href='login.php'">
                <input type="submit" id="loggout-button" class="indexbutton" name="logout" value="登出">
            </form>
        </div>
        <?php
            include("link.php");
            if(isset($_SESSION["data"])){
                ?>
                <div class="loginhead">
                    <button class="button2 selectbut" onclick="location.href='login.php'">留言管理</button>
                    <button class="button2" onclick="location.href='comp.php'">賽制管理</button>
                </div>
                <div class="post" id="post">
                    <div class="posthead">
                        <div class="posttitle">玩家留言列表</div>
                    </div>
                    <div class="postbody">
                        <?php
                            $data=mysqli_query($db,"SELECT*FROM `message`");
                            $a=[];
                            while($row=mysqli_fetch_row($data)){
                                array_push($a,$row);
                            }
                            for($i=0;$i<sizeof($a)-1;$i=$i+1){
                                for($j=0;$j<sizeof($a)-$i-1;$j=$j+1){
                                    if($a[$j][8]<$a[$j+1][8]){
                                        $tamp=$a[$j];
                                        $a[$j]=$a[$j+1];
                                        $a[$j+1]=$tamp;
                                    }
                                }
                            }
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
                                                <td class="pictre" rowspan="4"><div style="height:100px;width:50px;"><?= $a[$i][9] ?></div></td>
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
                    $row=mysqli_fetch_row(mysqli_query($db,"SELECT*FROM `message` WHERE `sn`='$sn'"))
                    ?>
                    <div class="newchatdiv" id="editchatdiv">
                        <div class="signupdiv">
                            <form>
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
                    </div>
                    <?php
                }
                if(isset($_GET["del"])){
                    $sn=$_GET["del"];
                    mysqli_query($db,"DELETE FROM `message` WHERE `sn`='$sn'");
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
                                mysqli_query($db,"UPDATE `message` SET `username`='$username',`message`='$message',`email`='$email',`emailbox`='yes',`tel`='$tel',`telbox`='yes',`edit`='$date' WHERE `sn`='$sn'");
                                ?><script>alert("更改成功!");location.href="login.php"</script><?php
                            }else{
                                mysqli_query($db,"UPDATE `message` SET `username`='$username',`message`='$message',`email`='$email',`emailbox`='yes',`tel`='$tel',`telbox`='no',`edit`='$date' WHERE `sn`='$sn'");
                                ?><script>alert("更改成功!");location.href="login.php"</script><?php
                            }
                        }else{
                            if(isset($telbox)){
                                mysqli_query($db,"UPDATE `message` SET `username`='$username',`message`='$message',`email`='$email',`emailbox`='no',`tel`='$tel',`telbox`='yes',`edit`='$date' WHERE `sn`='$sn'");
                                ?><script>alert("更改成功!");location.href="login.php"</script><?php
                            }else{
                                mysqli_query($db,"UPDATE `message` SET `username`='$username',`message`='$message',`email`='$email',`emailbox`='no',`tel`='$tel',`telbox`='no',`edit`='$date' WHERE `sn`='$sn'");
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
                <div class="indexdiv">
                    <form>
                        <class class="indextitle">Shanghai Battle!</class><br>
                        <div class="text">
                            帳號: <input type="text" name="username" id="username" value="<?= @$_SESSION["username"] ?>" class="input"><br>
                        </div>
                        <div class="text">
                            密碼: <input type="password" name="code" id="code" value="<?= @$_SESSION["password"] ?>" class="input"><br>
                        </div>
                        <div class="text">
                            驗證碼: <input type="text" name="verify" id="code" value="<?= @$_SESSION["verify"] ?>" class="input"><br>
                        </div>
                        <class class="text">驗證碼:</class>
                        <?php
                            $a="";
                            for($i=0;$i<4;$i=$i+1){
                                $str=range("0","9");
                                $finalStr = $str[rand(0,9)];
                                $a=$a.$finalStr;
                            }
                        ?>
                        <input type="hidden" name="verifyans" id="code" value="<?= $a ?>" class="input">
                        <div class="verifybox" id="dragbox">
                            <?php echo($a); ?>
                        </div>
                        <input type="submit" name="reflashpng" value="重新產生" class="button"><br>
                        <input type="submit" value="清除" name="clear" class="button">
                        <button type="submit" class="button" name="login" id="login">登入</button><br><br>
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
                                $user=mysqli_query($db,"SELECT*FROM `user` WHERE `username`='$username'");
                                if($row=mysqli_fetch_row($user)){
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
                        ?>
                    </form>
                </div>
                <?php
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
            if(isset($_GET["pin"])){
                $sn=$_GET["pin"];
                $row=mysqli_fetch_row(mysqli_query($db,"SELECT*FROM `message` WHERE `sn`='$sn'"));
                if($row[13]=="yes"){
                    mysqli_query($db,"UPDATE `message` SET `pin`='' WHERE `sn`='$sn'");
                    ?><script>alert("解訂成功!");location.href="login.php"</script><?php
                }else{
                    mysqli_query($db,"UPDATE `message` SET `pin`='yes' WHERE `sn`='$sn'");
                    ?><script>alert("訂選成功!");location.href="login.php"</script><?php
                }
            }
            if(isset($_GET["resp"])){
                $sn=$_GET["resp"];
                $row=mysqli_fetch_row(mysqli_query($db,"SELECT*FROM `message` WHERE `sn`='$sn'"))
                ?>
                <div class="adminresp" id="editchatdiv">
                    <div class="signupdiv">
                        <form>
                            <div class="title">管理員留言</div>
                            留言內容: <textarea name="message" rows="1" cols="25"><?= @$row[12] ?></textarea><br>
                            留言序號:<input type="text" name="sn" placeholder="4位數字" style="width: 50px;" value="<?= @$sn ?>" readonly>
                            <input type="submit" name="respsubmit" class="button" value="送出">
                            <input type="button" onclick="location.href='login.php'" class="button" value="返回"><br>
                        </form>
                    </div>
                </div>
                <?php
            }
            if(isset($_GET["respsubmit"])){
                $message=$_GET["message"];
                $sn=$_GET['sn'];
                mysqli_query($db,"UPDATE `message` SET `respond`='$message' WHERE `sn`='$sn'");
                ?><script>alert("更改成功!");location.href="login.php"</script><?php
            }
        ?>
        <script src="index.js"></script>
    </body>
</html>
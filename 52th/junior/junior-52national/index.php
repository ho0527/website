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
                    <input type="button" id="index" value="玩家留言" class="indexbutton selectbut" onclick="location.href='index.php'">
                    <input type="button" id="view" value="玩家參賽" class="indexbutton" onclick="location.href='post.php'">
                    <input type="button" id="signup" value="網站管理" class="indexbutton" onclick="location.href='login.php'">
                    <input type="submit" id="loggout-button" class="indexbutton" name="logout" value="登出">
                </form>
            </div>
        <div id="main">
            <div class="pinchat">
                <div class="pinchattitle">
                    玩家留言區塊
                    <input type="button" id="allchat" value="所有留言" style="float:right;">
                </div>
                <div class="pinpostmessage">
                    <?php
                        include("link.php");
                        $a=fetchall(query("SELECT*FROM `message` WHERE `pin`='yes'"));
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
                            $id=$a[$i][0];
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
                                            <td class="adminmessage" colspan="3">管理員回應: 無</td>
                                            <?php
                                        }else{
                                            ?>
                                            <td class="adminmessage" colspan="3">管理員回應: <?= $a[$i][12] ?></td>
                                            <?php
                                        }
                                    ?>
                                </tr>
                            </table>
                            <?php
                        }
                    ?>
                </div>
            </div><br><br>
            <div class="news">
                <div class="newstitle">最新消息與賽制公告區塊</div>
                <div class="newsmessage">
                    <table class="compmaintable">
                        <?php
                        $comp=fetchall(query("SELECT*FROM `comp`"));
                        $maxid=fetch(query("SELECT MAX(`id`) FROM `comp`"))[0];
                        $countcomp=count($comp);
                        $maxnum=round($countcomp/2);
                        for($i=1;$i<=$maxnum;$i=$i+1){
                            $team=[];
                            for($j=1;$j<=$maxid;$j=$j+1){
                                $temporarystorage=fetch(query("SELECT*FROM `comp` WHERE `id`='$j' AND `team`='$i'"));
                                if($temporarystorage){
                                    $team[]=$temporarystorage;
                                }
                            }
                            if(count($team)==2&&$team[0]!=""){
                                query("UPDATE `comp` SET `ingame`='yes' WHERE `team`='$i'");
                                ?>
                                <tr>
                                    <td class="compplayerhead" name="playerhead<?= $team[0][0] ?>" rowspan="2"><?= $team[0][4] ?></td>
                                    <td class="compusername" name="username<?= $team[0][0] ?>" rowspan="2"><?= $team[0][1] ?></td>
                                    <td class="compemail" name="email<?= $team[0][0] ?>"><?= $team[0][2] ?></td>
                                    <td class="vs" rowspan="2">VS</td>
                                    <td class="compplayerhead" name="playerhead<?= $team[1] ?>" rowspan="2"><?= $team[1][4] ?></td>
                                    <td class="compusername" name="username<?= $team[1] ?>" rowspan="2"><?= $team[1][1] ?></td>
                                    <td class="compemail" name="email<?= $team[1] ?>"><?= $team[1][2] ?></td>
                                </tr>
                                <tr>
                                    <td class="compphone" name="phone<?= $team[0][0] ?>"><?= $team[0][3] ?></td>
                                    <td class="compphone" name="phone<?= $team[1] ?>"><?= $team[1][3] ?></td>
                                </tr>
                                <?php
                            }
                        }
                        for($i=0;$i<$countcomp;$i=$i+1){
                            $row=fetchall(query("SELECT*FROM `comp` WHERE `ingame`!='yes'"));
                        }
                        for($i=0;$i<count($row);$i=$i+1){
                            if($row){
                                ?>
                                <tr>
                                    <td class="compplayerhead" name="playerhead<?= $row[$i][0] ?>" rowspan="2"><?= $row[$i][4] ?></td>
                                    <td class="compusername" name="username<?= $row[$i][0] ?>" rowspan="2"><?= $row[$i][1] ?></td>
                                    <td class="compemail" name="email<?= $row[$i][0] ?>"><?= $row[$i][2] ?></td>
                                    <td class="vs" rowspan="2">配對中</td>
                                </tr>
                                <tr>
                                    <td class="compphone" name="phone<?= $row[$i][0] ?>"><?= $row[$i][3] ?></td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
        <div class="post" id="post">
            <div class="posthead">
                <div class="posttitle">玩家留言列表</div>
                <input type="button" value="新增留言" id="newchat" class="button3">
                <input type="button" value="返回" id="back" class="button3">
            </div>
            <div class="postbody">
                <?php
                    $a=fetchall(query("SELECT*FROM `message`"));
                    usort($a,function($a,$b){ return strcmp($b[8],$a[8]); });
                    for($i=0;$i<sizeof($a);$i=$i+1){
                        $id=$a[$i][0];
                        ?>
                        <table class="postmessage">
                            <tr>
                                <td class="username" rowspan="2"><?= $a[$i][2] ?></td>
                                <td class="message" rowspan="2"><?= $a[$i][3] ?></td>
                                <?php
                                    if($a[$i][9]!=""){
                                        ?>
                                        <td class="pictre" rowspan="4"><img src="<?= $a[$i][9] ?>" alt="" width="100px"></td>
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
                                                <input type="text" name="text" placeholder="留言序號" style="width: 75px;">
                                                <button type="submit" name="edit" value="<?= $a[$i][1] ?>">編輯</button>
                                                <button type="submit" name="del" value="<?= $a[$i][1] ?>">刪除</button>
                                            </form>
                                        </td>
                                        <?php
                                    }else{
                                        ?>
                                        <td class="edit" rowspan="4">
                                            <form>
                                                <input type="text" name="text" placeholder="已刪除" style="width: 75px;" disabled>
                                                <button type="submit" name="edit" value="<?= $a[$i][1] ?>" disabled>編輯</button>
                                                <button type="submit" name="del" value="<?= $a[$i][1] ?>" disabled>刪除</button>
                                            </form>
                                        </td>
                                        <?php
                                    }
                                ?>
                            </tr>
                            <tr></tr>
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
        <div class="newchatdiv" id="newchatdiv">
            <div class="signupdiv">
                <form method="POST" enctype="multipart/form-data">
                    <div class="title">玩家留言-新增</div>
                    姓&nbsp&nbsp名: <input type="text" class="indexinput" name="username" value="<?= @$_SESSION["name"] ?>"><br>
                    email: <input type="text" class="indexinput" name="email" placeholder="要有@及一個以上的." value="<?= @$_SESSION["email"] ?>"> 顯示:<input type="checkbox" name="emailbox" checked><br>
                    電&nbsp&nbsp話: <input type="text" class="indexinput" name="tel" placeholder="只能包含數字或-" value="<?= @$_SESSION["tel"] ?>"> 顯示:<input type="checkbox" name="telbox" checked><br>
                    留言內容: <textarea name="message" rows="1" cols="25"><?= @$_SESSION["message"] ?></textarea>
                    <input type="file" name="picture" accept="image/*"><br>
                    留言序號:<input type="text" name="sn" placeholder="4位數字" style="width: 50px;" value="<?= @$_SESSION["sn"] ?>">
                    <input type="submit" name="submit" class="button" value="送出">
                    <input type="button" onclick="location.href='index.php'" class="button" value="返回"><br>
                </form>
            </div>
        </div>
        <?php
            if(isset($_POST["submit"])){
                @$_SESSION["name"]=$_POST["username"];
                @$_SESSION["email"]=$_POST["email"];
                @$_SESSION["tel"]=$_POST["tel"];
                @$_SESSION["message"]=$_POST["message"];
                @$_SESSION["sn"]=$_POST["sn"];
                @$username=$_SESSION["name"];
                @$email=$_SESSION["email"];
                @$emailbox=$_POST["emailbox"];
                @$tel=$_SESSION["tel"];
                @$telbox=$_POST["telbox"];
                @$message=$_SESSION["message"];
                @$picture=$_FILES["picture"]["name"];
                @$sn=$_SESSION["sn"];
                $row=fetch(query("SELECT*FROM `message` WHERE `sn`='$sn'"));
                if(!preg_match("/^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,5}$/", $email)) {
                    ?><script>alert("email驗證失敗!");location.href="index.php"</script><?php
                }elseif(!preg_match("/^[0-9-]+$/",$tel)){
                    ?><script>alert("電話驗證失敗!");location.href="index.php"</script><?php
                }elseif(!preg_match("/^[0-9]{4}$/",$sn)){
                    ?><script>alert("序號驗證失敗!");location.href="index.php"</script><?php
                }elseif($row){
                    ?><script>alert("序號已存在!");location.href="index.php"</script><?php
                }elseif($username==""||$sn==""){
                    ?><script>alert("請輸入名字及序號!");location.href="index.php"</script><?php
                }else{
                    if(!empty($_FILES["picture"]["name"])){
                        move_uploaded_file($_FILES["picture"]["tmp_name"],"image/".$_FILES["picture"]["name"]);
                        $picture="image/".$_FILES["picture"]["name"];
                        if(isset($emailbox)){
                            if(isset($telbox)){
                                query("INSERT INTO `message`(`sn`, `username`, `message`, `email`, `emailbox`, `tel`, `telbox`, `date`, `picture`, `edit`, `del`, `respond`) VALUES ('$sn','$username','$message','$email','yes','$tel','yes','$date','$picture','','','')");
                            }else{
                                query("INSERT INTO `message`(`sn`, `username`, `message`, `email`, `emailbox`, `tel`, `telbox`, `date`, `picture`, `edit`, `del`, `respond`) VALUES ('$sn','$username','$message','$email','yes','$tel','no','$date','$picture','','','')");
                            }
                        }else{
                            if(isset($telbox)){
                                query("INSERT INTO `message`(`sn`, `username`, `message`, `email`, `emailbox`, `tel`, `telbox`, `date`, `picture`, `edit`, `del`, `respond`) VALUES ('$sn','$username','$message','$email','no','$tel','yes','$date','$picture','','','')");
                            }else{
                                query("INSERT INTO `message`(`sn`, `username`, `message`, `email`, `emailbox`, `tel`, `telbox`, `date`, `picture`, `edit`, `del`, `respond`) VALUES ('$sn','$username','$message','$email','no','$tel','no','$date','$picture','','','')");
                            }
                        }
                    }else{
                        if(isset($emailbox)){
                            if(isset($telbox)){
                                query("INSERT INTO `message`(`sn`, `username`, `message`, `email`, `emailbox`, `tel`, `telbox`, `date`, `picture`, `edit`, `del`, `respond`) VALUES ('$sn','$username','$message','$email','yes','$tel','yes','$date','','','','')");
                            }else{
                                query("INSERT INTO `message`(`sn`, `username`, `message`, `email`, `emailbox`, `tel`, `telbox`, `date`, `picture`, `edit`, `del`, `respond`) VALUES ('$sn','$username','$message','$email','yes','$tel','no','$date','','','','')");
                            }
                        }else{
                            if(isset($telbox)){
                                query("INSERT INTO `message`(`sn`, `username`, `message`, `email`, `emailbox`, `tel`, `telbox`, `date`, `picture`, `edit`, `del`, `respond`) VALUES ('$sn','$username','$message','$email','no','$tel','yes','$date','','','','')");
                            }else{
                                query("INSERT INTO `message`(`sn`, `username`, `message`, `email`, `emailbox`, `tel`, `telbox`, `date`, `picture`, `edit`, `del`, `respond`) VALUES ('$sn','$username','$message','$email','no','$tel','no','$date','','','','')");
                            }
                        }
                    }
                    unset($username,$email,$email,$tel,$message,$sn);
                    ?><script>alert("新增成功!");location.href="index.php"</script><?php
                }
            }
            if(isset($_GET["edit"])){
                $sn=$_GET["text"];
                if($sn==$_GET["edit"]){
                    $row=fetch(query("SELECT*FROM `message` WHERE `sn`='$sn'"))
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
                                <input type="button" onclick="location.href='index.php'" class="button" value="返回"><br>
                            </form>
                        </div>
                    </div>
                    <?php
                }else{
                    ?><script>alert("序號錯誤!");location.href="index.php"</script><?php
                }
            }
            if(isset($_GET["del"])){
                $sn=$_GET["text"];
                if($sn==$_GET["del"]){
                    query("UPDATE `message` SET `emailbox`='no',`telbox`='no',`del`='$date' WHERE `sn`='$sn'");
                    ?><script>alert("刪除成功!");location.href="index.php"</script><?php
                }else{
                    ?><script>alert("序號錯誤!");location.href="index.php"</script><?php
                }
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
                    ?><script>alert("email驗證失敗!");location.href="index.php"</script><?php
                }elseif(!preg_match("/^[0-9-]+$/",$tel)){
                    ?><script>alert("電話驗證失敗!");location.href="index.php"</script><?php
                }elseif($username==""){
                    ?><script>alert("請輸入名字!");location.href="index.php"</script><?php
                }else{
                    if(isset($emailbox)){
                        if(isset($telbox)){
                            query("UPDATE `message` SET `username`='$username',`message`='$message',`email`='$email',`emailbox`='yes',`tel`='$tel',`telbox`='yes',`edit`='$date' WHERE `sn`='$sn'");
                        }else{
                            query("UPDATE `message` SET `username`='$username',`message`='$message',`email`='$email',`emailbox`='yes',`tel`='$tel',`telbox`='no',`edit`='$date' WHERE `sn`='$sn'");
                        }
                    }else{
                        if(isset($telbox)){
                            query("UPDATE `message` SET `username`='$username',`message`='$message',`email`='$email',`emailbox`='no',`tel`='$tel',`telbox`='yes',`edit`='$date' WHERE `sn`='$sn'");
                        }else{
                            query("UPDATE `message` SET `username`='$username',`message`='$message',`email`='$email',`emailbox`='no',`tel`='$tel',`telbox`='no',`edit`='$date' WHERE `sn`='$sn'");
                        }
                    }
                    ?><script>alert("更改成功!");location.href="index.php"</script><?php
                }
            }
        ?>
        <script src="index.js"></script>
    </body>
</html>
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
                        $data=query("SELECT*FROM `message` WHERE `pin`='yes'");
                        $a=[];
                        while($row=fetch($data)){
                            $a[]=$row;
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
                    $data=query("SELECT*FROM `message`");
                    $a=[];
                    while($row=fetch($data)){
                        $a[]=$row;
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
        <div class="newchatdiv" id="newchatdiv">
            <div class="signupdiv">
                <form>
                    <div class="title">玩家留言-新增</div>
                    姓&nbsp&nbsp名: <input type="text" class="indexinput" name="username" value="<?= @$_SESSION["name"] ?>"><br>
                    email: <input type="text" class="indexinput" name="email" placeholder="要有@及一個以上的." value="<?= @$_SESSION["email"] ?>"> 顯示:<input type="checkbox" name="emailbox" checked><br>
                    電&nbsp&nbsp話: <input type="text" class="indexinput" name="tel" placeholder="只能包含數字或-" value="<?= @$_SESSION["tel"] ?>"> 顯示:<input type="checkbox" name="telbox" checked><br>
                    留言內容: <textarea name="message" rows="1" cols="25"><?= @$_SESSION["message"] ?></textarea><input type="file" name="picture" accept="image/*" style="width:70px">64KB以下<br>
                    留言序號:<input type="text" name="sn" placeholder="4位數字" style="width: 50px;" value="<?= @$_SESSION["sn"] ?>">
                    <input type="submit" name="submit" class="button" value="送出">
                    <input type="button" onclick="location.href='index.php'" class="button" value="返回"><br>
                </form>
            </div>
        </div>
        <?php
            if(isset($_GET["submit"])){
                @$username=$_GET["username"];
                @$email=$_GET["email"];
                @$emailbox=$_GET["emailbox"];
                @$tel=$_GET["tel"];
                @$telbox=$_GET["telbox"];
                @$message=$_GET["message"];
                @$picture=$_FILES["picture"]["name"];
                @$sn=$_GET['sn'];
                @$_SESSION["name"]=$username;
                @$_SESSION["email"]=$email;
                @$_SESSION["tel"]=$tel;
                @$_SESSION["message"]=$message;
                @$_SESSION["sn"]=$sn;
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
                    $targetDir="uploads/";
                    $fileName=basename($picture);
                    $targetFilePath=$targetDir . $fileName;
                    $fileType=pathinfo($targetFilePath,PATHINFO_EXTENSION);
                    if(!empty($picture)){
                        // Allow certain file formats
                        $allowTypes=array('jpg','png','jpeg','gif','pdf');
                        if(in_array($fileType, $allowTypes)){
                            // Upload file to server
                            if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
                                // Insert image file name into database
                                if(isset($emailbox)){
                                    if(isset($telbox)){
                                        query("INSERT INTO `message`(`sn`, `username`, `message`, `email`, `emailbox`, `tel`, `telbox`, `date`, `picture`, `edit`, `del`, `respond`) VALUES ('$sn','$username','$message','$email','yes','$tel','yes','$date','','','','')");
                                        ?><script>alert("新增成功!");location.href="index.php"</script><?php
                                        @$_SESSION["name"]="";
                                        @$_SESSION["email"]="";
                                        @$_SESSION["tel"]="";
                                        @$_SESSION["message"]="";
                                        @$_SESSION["sn"]="";
                                    }else{
                                        query("INSERT INTO `message`(`sn`, `username`, `message`, `email`, `emailbox`, `tel`, `telbox`, `date`, `picture`, `edit`, `del`, `respond`) VALUES ('$sn','$username','$message','$email','yes','$tel','no','$date','','','','')");
                                        ?><script>alert("新增成功!");location.href="index.php"</script><?php
                                        @$_SESSION["name"]="";
                                        @$_SESSION["email"]="";
                                        @$_SESSION["tel"]="";
                                        @$_SESSION["message"]="";
                                        @$_SESSION["sn"]="";
                                    }
                                }else{
                                    if(isset($telbox)){
                                        query("INSERT INTO `message`(`sn`, `username`, `message`, `email`, `emailbox`, `tel`, `telbox`, `date`, `picture`, `edit`, `del`, `respond`) VALUES ('$sn','$username','$message','$email','no','$tel','yes','$date','','','','')");
                                        ?><script>alert("新增成功!");location.href="index.php"</script><?php
                                        @$_SESSION["name"]="";
                                        @$_SESSION["email"]="";
                                        @$_SESSION["tel"]="";
                                        @$_SESSION["message"]="";
                                        @$_SESSION["sn"]="";
                                    }else{
                                        query("INSERT INTO `message`(`sn`, `username`, `message`, `email`, `emailbox`, `tel`, `telbox`, `date`, `picture`, `edit`, `del`, `respond`) VALUES ('$sn','$username','$message','$email','no','$tel','no','$date','','','','')");
                                        ?><script>alert("新增成功!");location.href="index.php"</script><?php
                                        @$_SESSION["name"]="";
                                        @$_SESSION["email"]="";
                                        @$_SESSION["tel"]="";
                                        @$_SESSION["message"]="";
                                        @$_SESSION["sn"]="";
                                    }
                                }
                                $insert = $db->query("INSERT into images (file_name, uploaded_on) VALUES ('".$fileName."', NOW())");
                                ?><script>alert("The file has been uploaded successfully.!");location.href="index.php"</script><?php
                            }else{
                                ?><script>alert("Sorry, there was an error uploading your file.!");location.href="index.php"</script><?php
                            }
                        }else{
                            ?><script>alert("Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.!");location.href="index.php"</script><?php
                        }
                    }else{
                        if(isset($emailbox)){
                            if(isset($telbox)){
                                query("INSERT INTO `message`(`sn`, `username`, `message`, `email`, `emailbox`, `tel`, `telbox`, `date`, `picture`, `edit`, `del`, `respond`) VALUES ('$sn','$username','$message','$email','yes','$tel','yes','$date','','','','')");
                                ?><script>alert("新增成功!");location.href="index.php"</script><?php
                                @$_SESSION["name"]="";
                                @$_SESSION["email"]="";
                                @$_SESSION["tel"]="";
                                @$_SESSION["message"]="";
                                @$_SESSION["sn"]="";
                            }else{
                                query("INSERT INTO `message`(`sn`, `username`, `message`, `email`, `emailbox`, `tel`, `telbox`, `date`, `picture`, `edit`, `del`, `respond`) VALUES ('$sn','$username','$message','$email','yes','$tel','no','$date','','','','')");
                                ?><script>alert("新增成功!");location.href="index.php"</script><?php
                                @$_SESSION["name"]="";
                                @$_SESSION["email"]="";
                                @$_SESSION["tel"]="";
                                @$_SESSION["message"]="";
                                @$_SESSION["sn"]="";
                            }
                        }else{
                            if(isset($telbox)){
                                query("INSERT INTO `message`(`sn`, `username`, `message`, `email`, `emailbox`, `tel`, `telbox`, `date`, `picture`, `edit`, `del`, `respond`) VALUES ('$sn','$username','$message','$email','no','$tel','yes','$date','','','','')");
                                ?><script>alert("新增成功!");location.href="index.php"</script><?php
                                @$_SESSION["name"]="";
                                @$_SESSION["email"]="";
                                @$_SESSION["tel"]="";
                                @$_SESSION["message"]="";
                                @$_SESSION["sn"]="";
                            }else{
                                query("INSERT INTO `message`(`sn`, `username`, `message`, `email`, `emailbox`, `tel`, `telbox`, `date`, `picture`, `edit`, `del`, `respond`) VALUES ('$sn','$username','$message','$email','no','$tel','no','$date','','','','')");
                                ?><script>alert("新增成功!");location.href="index.php"</script><?php
                                @$_SESSION["name"]="";
                                @$_SESSION["email"]="";
                                @$_SESSION["tel"]="";
                                @$_SESSION["message"]="";
                                @$_SESSION["sn"]="";
                            }
                        }
                    }
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
                echo("1233");
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
                            ?><script>alert("更改成功!");location.href="index.php"</script><?php
                        }else{
                            query("UPDATE `message` SET `username`='$username',`message`='$message',`email`='$email',`emailbox`='yes',`tel`='$tel',`telbox`='no',`edit`='$date' WHERE `sn`='$sn'");
                            ?><script>alert("更改成功!");location.href="index.php"</script><?php
                        }
                    }else{
                        if(isset($telbox)){
                            query("UPDATE `message` SET `username`='$username',`message`='$message',`email`='$email',`emailbox`='no',`tel`='$tel',`telbox`='yes',`edit`='$date' WHERE `sn`='$sn'");
                            ?><script>alert("更改成功!");location.href="index.php"</script><?php
                        }else{
                            query("UPDATE `message` SET `username`='$username',`message`='$message',`email`='$email',`emailbox`='no',`tel`='$tel',`telbox`='no',`edit`='$date' WHERE `sn`='$sn'");
                            ?><script>alert("更改成功!");location.href="index.php"</script><?php
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
        ?>
        <script src="index.js"></script>
    </body>
</html>
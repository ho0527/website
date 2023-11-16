<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="index.css">
    </head>
    <body>
        <?php
            include("link.php");
        ?>
        <div class="nbar">
            <img src="media/icon/mainicon.gif" class="logo">
            <div class="admintimer">
                <input type="text" class="nobackground" id="show" value="<?= $_SESSION["timer"]; ?>" readonly>
                <form class="inline">
                    <input type="text" name="timer" id="text" value="<?= $_SESSION["timer"]; ?>">
                    <input type="submit" name="timesubmit" value="送出">
                </form>
                <input type="button" onclick="location.reload()" value="重新計時">
            </div>
            <h1 class="title">咖啡商品展示系統</h1>
        </div>
        <div class="nbar2">
            <?php
                if($_SESSION["permission"]=="管理者"){
                    ?>
                    <div class="nbarbutton">
                        <input type="button" onclick="location.href='newuser.php'" value="新增使用者">
                        <input type="button" onclick="location.href='main.php'" value="標題">
                        <input type="button" onclick="location.href='product1.html'" value="上架商品">
                        <input type="button" onclick="location.href='admin.php'" value="會員管理">
                        <input type="button" onclick="location.href='api/api.php?logout='" value="登出">
                    </div>
                    <?php
                }else{
                    ?>
                    <div class="nbarbutton">
                        <input type="button" onclick="location.href='main.php'" value="標題">
                        <input type="button" onclick="location.href='api/api.php?logout='" value="登出">
                    </div>
                    <?php
                }
            ?>
        </div><br><br><br>
        <div class="top">
            <h1>使用者管理</h1>
            <div class="center">
                查詢:
                <form class="inline">
                    <input type="text" name="search">
                    <input type="submit" name="submit" value="送出">
                </form>
            </div>
            <table class="admintable">
                <?php
                    $ob="number";
                    $ot="ASC";
                    $ot1="DESC";
                    $ot2="DESC";
                    $ot3="DESC";
                    $ov1="升冪";
                    $ov2="升冪";
                    $ov3="升冪";
                    if(isset($_GET["ob"])){
                        if($_GET["ob"]=="number"){
                            if($_GET["ot"]=="ASC"){
                                $ob="number";
                                $ot="ASC";
                            }else{
                                $ob="number";
                                $ot="DESC";
                                $ot1="ASC";
                                $ov1="降冪";
                            }
                        }else if($_GET["ob"]=="username"){
                            if($_GET["ot"]=="ASC"){
                                $ob="username";
                                $ot="ASC";
                            }else{
                                $ob="username";
                                $ot="DESC";
                                $ot2="ASC";
                                $ov2="降冪";
                            }
                        }else{
                            if($_GET["ot"]=="ASC"){
                                $ob="name";
                                $ot="ASC";
                            }else{
                                $ob="name";
                                $ot="DESC";
                                $ot3="ASC";
                                $ov3="降冪";
                            }
                        }
                    }

                ?>
                <tr>
                    <td class="admintd">使用者編號 <input type="button" onclick="location.href='?ob=number&ot=<?= $ot1 ?>'" value="<?= $ov1 ?>"></td>
                    <td class="admintd">帳號 <input type="button" onclick="location.href='?ob=username&ot=<?= $ot2 ?>'" value="<?= $ov2 ?>"></td>
                    <td class="admintd">密碼 </td>
                    <td class="admintd">姓名 <input type="button" onclick="location.href='?ob=name&ot=<?= $ot3 ?>'" value="<?= $ov3 ?>"></td>
                    <td class="admintd">權限</td>
                    <td class="admintd">function</td>
                </tr>
                <?php
                    if(isset($_SESSION["search"])){
                        $text=$_SESSION["search"];
                    }else{
                        $_SESSION["search"]="";
                        $text=$_SESSION["search"];
                    }
                    $row=query($db,"SELECT*FROM `user` WHERE `number`LIKE?OR`username`LIKE?OR`password`LIKE?OR`name`LIKE?",["%$text%","%$text%","%$text%","%$text%"]);
                    for($i=0;$i<count($row);$i=$i+1){
                        ?>
                        <tr>
                            <td class="admintd"><?= $row[$i][5] ?></td>
                            <td class="admintd"><?= $row[$i][1] ?></td>
                            <td class="admintd"><?= $row[$i][2] ?></td>
                            <td class="admintd"><?= $row[$i][3] ?></td>
                            <td class="admintd"><?= $row[$i][4] ?></td>
                            <td class="admintd">
                                <?php
                                    if($row[$i][0]==1){
                                        ?>
                                        <input type="button" value="修改">
                                        <input type="button" value="刪除">
                                        <?php
                                    }else{
                                        ?>
                                        <input type="button" onclick="location.href='edituser.php?edituser=&id=<?= $row[$i][0] ?>'" value="修改">
                                        <input type="button" onclick="location.href='api/api.php?deluser=&id=<?= $row[$i][0] ?>'" value="刪除">
                                        <?php
                                    }
                                ?>
                            </td>
                        </tr>
                        <?php
                    }
                ?>
            </table>
        </div><br><br>
        <div class="bottom">
            <h1>登入登出紀錄</h1>
            <table class="admintable">
                <tr>
                    <td class="admintd">使用者編號</td>
                    <td class="admintd">帳號</td>
                    <td class="admintd">姓名</td>
                    <td class="admintd">時間</td>
                    <td class="admintd">動作(登入/登出)</td>
                    <td class="admintd">成功/失敗</td>
                </tr>
                <?php
                    $logrow=query($db,"SELECT*FROM `log` ORDER BY `id` DESC");
                    for($i=0;$i<count($logrow);$i=$i+1){
                        ?>
                        <tr>
                            <td class="admintd"><?= $logrow[$i][1] ?></td>
                            <td class="admintd"><?= $logrow[$i][2] ?></td>
                            <td class="admintd"><?= $logrow[$i][3] ?></td>
                            <td class="admintd"><?= $logrow[$i][4] ?></td>
                            <td class="admintd"><?= $logrow[$i][5] ?></td>
                            <td class="admintd"><?= $logrow[$i][6] ?></td>
                        </tr>
                        <?php
                    }
                ?>
            </table>
        </div>
        <div class="lightbox" id="lightbox">
            <div class="lightboxmask"></div>
            <div class="main z999">
                是否繼續操作? <br><br>
                <input type="button" onclick="location.reload()" value="Yes">
                <input type="button" onclick="location.href='api/api.php?logout='" value="否">
            </div>
        </div>
        <?php
            if(isset($_GET["submit"])){
                $_SESSION["search"]=$_GET["search"];
            }
            if(isset($_GET["timesubmit"])){
                $_SESSION["timer"]=$_GET["timer"];
                ?><script>location.href="admin.php"</script><?php
            }
        ?>
        <script src="admin.js"></script>
    </body>
</html>
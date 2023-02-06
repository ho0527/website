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
                    <button class="button2" onclick="location.href='login.php'">留言管理</button>
                    <button class="button2 selectbut" onclick="location.href='comp.php'">賽制管理</button>
                </div>
                <div class="compdiv">
                    <form>
                        <?php
                        $data=query("SELECT*FROM `comp`");
                        $row=fetchall($data);
                        $countrow=count($row);
                        print_r($row);
                        function group($countrow){
                            $totalcount=1;
                            $result=[];
                            while($totalcount<=$countrow){
                                $rand=rand(1,$countrow-1);
                                $result[]=$rand;
                                $time=1;
                                for($i=0;$i<count($result)-1;$i=$i+1){
                                    if($result[$i]==$rand){
                                        $time=$time+1;
                                        if($time>2){
                                            array_pop($result);
                                            $totalcount=$totalcount-1;
                                        }
                                    }
                                }
                                $totalcount=$totalcount+1;
                            }
                            print_r($result);
                        }
                        for($i=0;$i<$countrow;$i=$i+1){
                            ?>
                            <div class="compplayerhead" name="playerhead<?= $row[$i][0] ?>"><?= $row[$i][4] ?></div>
                            <div class="compusername" name="username<?= $row[$i][0] ?>"><?= $row[$i][1] ?></div>
                            <div class="compemail" name="email<?= $row[$i][0] ?>"><?= $row[$i][2] ?></div>
                            <div class="compphone" name="phone<?= $row[$i][0] ?>"><?= $row[$i][3] ?></div>
                            <?php
                        }
                        ?>
                        <input type="submit" value="亂數配對" name="submit">
                    </form>
                </div>
                <?php
            }else{
                ?><script>alert("請先登入");location.href="login.php"</script><?php
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
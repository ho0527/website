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
                        <table class="compmaintable">
                        <?php
                        $row=fetchall(query("SELECT*FROM `comp`"));
                        $countrow=count($row);
                        $maxnum=round($countrow/2);
                        $team=[];
                        for($i=1;$i<=$maxnum;$i=$i+1){
                            for($j=1;$j<=$countrow;$j=$j+1){
                                $team[]=fetchall(query("SELECT*FROM `comp` WHERE `id`='$j' AND `team`='$i'"));
                            }
                            if(count($team)==2){
                                query("UPDATE `comp` SET `ingame`='yes' WHERE `team`='$maxnum'");
                                ?>
                                <tr>
                                    <td class="compplayerhead" name="playerhead<?= $team[0][0][0] ?>" rowspan="2"><?= $team[0][0][4] ?></td>
                                    <td class="compusername" name="username<?= $team[0][0][0] ?>" rowspan="2"><?= $team[0][0][1] ?></td>
                                    <td class="compemail" name="email<?= $team[0][0][0] ?>"><?= $team[0][0][2] ?></td>
                                    <td class="vs" rowspan="2">VS</td>
                                    <td class="compplayerhead" name="playerhead<?= $team[1][0][0] ?>" rowspan="2"><?= $team[1][0][4] ?></td>
                                    <td class="compusername" name="username<?= $team[1][0][0] ?>" rowspan="2"><?= $team[1][0][1] ?></td>
                                    <td class="compemail" name="email<?= $team[1][0][0] ?>"><?= $team[1][0][2] ?></td>
                                    <td class="disabled" rowspan="2"><button name="cancel" value="<?= $team[0][0][0] ?> <?= $team[1][0][0] ?>">取消配對</button></td>
                                </tr>
                                <tr>
                                    <td class="compphone" name="phone<?= $team[0][0][0] ?>"><?= $team[0][0][3] ?></td>
                                    <td class="compphone" name="phone<?= $team[1][0][0] ?>"><?= $team[1][0][3] ?></td>
                                </tr>
                                <?php
                            }else{
                                ?>
                                <tr>
                                    <td class="compplayerhead" name="playerhead<?= $team[0][0][0] ?>" rowspan="2"><?= $team[0][0][4] ?></td>
                                    <td class="compusername" name="username<?= $team[0][0][0] ?>" rowspan="2"><?= $team[0][0][1] ?></td>
                                    <td class="compemail" name="email<?= $team[0][0][0] ?>"><?= $team[0][0][2] ?></td>
                                    <td class="vs" rowspan="2">配對中</td>
                                </tr>
                                <tr>
                                    <td class="compphone" name="phone<?= $team[0][0][0] ?>"><?= $team[0][0][3] ?></td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                        </table>
                        <input type="submit" value="亂數配對" name="submit">
                    </form>
                </div>
                <?php
                if(isset($_GET["submit"])){
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
                    for($i=0;$i<count($result);$i=$i+1){
                        $fetch=$row[$i][0];
                        echo $fetch;
                        $notingame=fetch(query("SELECT*FROM `comp` WHERE `id`='$fetch' AND `ingame`!='yes'"));
                        if($notingame){
                            query("UPDATE `comp` SET `team`='$result[$i]' WHERE `id`='$fetch'");
                        }
                    }
                    ?><script>alert("亂數成功!");location.href="comp.php"</script><?php
                }
            }else{
                ?><script>alert("請先登入!");location.href="login.php"</script><?php
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
            if(isset($_GET["cancel"])){
                $arr=explode(" ",$_GET["cancel"]);
                print_r($arr);
                for($i=0;$i<count($arr);$i=$i+1){
                    query("UPDATE `comp` SET `ingame`='no',`team`='' WHERE `id`='$arr[$i]'");
                }
                ?><script>alert("取消配對成功!");location.href="comp.php"</script><?php
            }
        ?>
        <script src="index.js"></script>
    </body>
</html>
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
                        <input type="button" class="loginbutton button" onclick="location.href='login.php'" value="留言管理">
                        <input type="button" class="loginbutton button selectbutton" onclick="location.href='comp.php'" value="賽制管理">
                    </div>
                </div>
                <div class="compdiv">
                    <form>
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
                                        <td class="compplayerhead" name="playerhead<?= $team[0][0] ?>" rowspan="2"><img src="<?= $team[0][4] ?>" alt="" width="100px"></td>
                                        <td class="compusername" name="username<?= $team[0][0] ?>" rowspan="2"><?= $team[0][1] ?></td>
                                        <td class="compemail" name="email<?= $team[0][0] ?>"><?= $team[0][2] ?></td>
                                        <td class="vs" rowspan="2">VS</td>
                                        <td class="compplayerhead" name="playerhead<?= $team[1][0] ?>" rowspan="2"><img src="<?= $team[1][4] ?>" alt="" width="100px"></td>
                                        <td class="compusername" name="username<?= $team[1] ?>" rowspan="2"><?= $team[1][1] ?></td>
                                        <td class="compemail" name="email<?= $team[1] ?>"><?= $team[1][2] ?></td>
                                        <td class="disabled" rowspan="2"><button name="cancel" value="<?= $team[0][0] ?> <?= $team[1][0] ?>">取消配對</button></td>
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
                                        <td class="compplayerhead" name="playerhead<?= $team[$i][0] ?>" rowspan="2"><img src="<?= $team[$i][4] ?>" alt="" width="100px"></td>
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
                        <input type="submit" class="random" name="submit" value="亂數配對">
                    </form>
                </div>
                <?php
                if(isset($_GET["submit"])){
                    $totalcount=1;
                    $result=[];
                    while($totalcount<=$countcomp){
                        $ingame=[];
                        $ingame=fetch(query("SELECT `team` FROM `comp` WHERE `ingame`='yes'"));
                        $rand=rand(1,($countcomp/2));
                        $result[]=$rand;
                        $time=1;
                        if(!empty($ingame)){
                            for($i=0;$i<count($ingame);$i=$i+1){
                                if($result==$ingame[$i]){
                                    array_pop($result);
                                    $totalcount=$totalcount-1;
                                }
                            }
                        }
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
                    for($i=0;$i<count($result);$i=$i+1){
                        $fetch=$comp[$i][0];
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
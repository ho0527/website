<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>咖啡商品展示系統</title>
    <link rel="stylesheet" href="index.css">
    <style>
        .main{
            width: 75%;
            height: 650px;
            max-height: 650px;
            overflow-y: auto;
        }
    </style>
</head>
<body>
    <?php
        include("link.php");
        if(!isset($_SESSION["data"])){ header("location:index.php"); }
        if($_SESSION["permission"]=="管理者"){
            ?>
            <h1>咖啡商品展示系統</h1>
            <input type="button" class="but selt" onclick="location.href='main.php'" value="首頁">
            <input type="button" class="but" onclick="location.href='productindex.php'" value="上架商品">
            <input type="button" class="but" onclick="location.href='admin.php'" value="會員管理">
            <input type="button" class="but" onclick="location.href='link.php?logout='" value="登出">
            <hr>
            <div class="main">
                <form action="">
                    數字範圍: <input type="number" name="start" value="-10000000000000000000000">~<input type="number" name="end" value="1000000000000000000000">
                    <input type="submit" name="num" value="查尋">
                </form>
                <form action="">
                    關鍵字: <input type="text" name="text" id="">
                    <input type="submit" name="tex" value="查尋">
                </form><br><br>
                <table class="ptable">
                    <?php
                        if(isset($_GET["num"])){
                            $start=$_GET["start"];
                            $end=$_GET["end"];
                            $row=fetchall(query($db,"SELECT*FROM `coffee` WHERE '$start'<=`cost`AND`cost`<='$end'"));
                        }elseif(isset($_GET["tex"])){
                            $type=$_GET["text"];
                            $row=fetchall(query($db,"SELECT*FROM `coffee` WHERE `cost`LIKE'%$type%'or`name`LIKE'%$type%'or`link`LIKE'%$type%'or`date`LIKE'%$type%'or`intr`LIKE'%$type%'"));
                        }else{
                            $row=fetchall(query($db,"SELECT*FROM `coffee`"));
                        }
                        usort($row,function($a,$b){ return $a[5]<$b[5]||$a[5]==$b[5]&&$a[0]>$b[0]; });
                        for($i=0;$i<count($row);$i++){
                            if($row[$i][7]=="1"){
                                ?>
                                <tr>
                                    <td>
                                        <table class="ctable">
                                            <tr>
                                                <td class="coffee"><?php echo("商品名稱".$row[$i][2]) ?></td>
                                                <td class="coffee"><?php echo("費用".$row[$i][3]) ?></td>
                                            </tr>
                                            <tr>
                                                <td class="coffee" rowspan="3"><img src="<?= $row[$i][1] ?>" alt="圖片" width="200px" height="175px"></td>
                                                <td class="coffee"><?php echo("商品簡介".$row[$i][6]) ?></td>
                                            </tr>
                                            <tr>
                                                <td class="coffee"><?php echo("發佈日期".$row[$i][5]) ?></td>
                                            </tr>
                                            <tr>
                                                <td class="coffee"><?php echo("相關連結".$row[$i][4]) ?></td>
                                            </tr>
                                        </table>
                                        <input type="button" class="but" onclick="location.href='edit.php?pedit=<?= $row[$i][0] ?>'" value="修改"><br><br>
                                    </td>
                                </tr>
                                <?php
                            }else{
                                ?>
                                <tr>
                                    <td>
                                        <table class="ctable">
                                            <tr>
                                                <td class="coffee" rowspan="3"><img src="<?= $row[$i][1] ?>" alt="圖片" width="200px" height="175px"></td>
                                                <td class="coffee"><?php echo("商品名稱".$row[$i][2]) ?></td>
                                            </tr>
                                            <tr>
                                                <td class="coffee"><?php echo("商品簡介".$row[$i][6]) ?></td>
                                            </tr>
                                            <tr>
                                                <td class="coffee"><?php echo("發佈日期".$row[$i][5]) ?></td>
                                            </tr>
                                            <tr>
                                                <td class="coffee"><?php echo("相關連結".$row[$i][4]) ?></td>
                                                <td class="coffee"><?php echo("費用".$row[$i][3]) ?></td>
                                            </tr>
                                        </table>
                                        <input type="button" class="but" onclick="location.href='edit.php?pedit=<?= $row[$i][0] ?>'" value="修改"><br><br>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                </table><br>
            </div>
            <?php
        }else{
            ?>
            <h1>咖啡商品展示系統</h1>
            <input type="button" class="but selt" onclick="location.href='main.php'" value="首頁">
            <input type="button" class="but" onclick="location.href='productindex.php'" value="上架商品">
            <input type="button" class="but" onclick="location.href='admin.php'" value="會員管理">
            <input type="button" class="but" onclick="location.href='link.php?logout='" value="登出">
            <hr>
            <div class="main">
                <form action="">
                    數字範圍: <input type="number" name="start" value="-10000000000000000000000">~<input type="number" name="end" value="1000000000000000000000">
                    <input type="submit" name="num" value="查尋">
                </form>
                <form action="">
                    關鍵字: <input type="text" name="text" id="">
                    <input type="submit" name="tex" value="查尋">
                </form>
                <table class="ptable">
                    <?php
                        if(isset($_GET["num"])){
                            $start=$_GET["start"];
                            $end=$_GET["end"];
                            $row=fetchall(query($db,"SELECT*FROM `coffee` WHERE '$start'<=`cost`AND`cost`<='$end'"));
                        }elseif(isset($_GET["tex"])){
                            $type=$_GET["text"];
                            $row=fetchall(query($db,"SELECT*FROM `coffee` WHERE `cost`LIKE'%$type%'or`name`LIKE'%$type%'or`link`LIKE'%$type%'or`date`LIKE'%$type%'or`intr`LIKE'%$type%'"));
                        }else{
                            $row=fetchall(query($db,"SELECT*FROM `coffee`"));
                        }
                        usort($row,function($a,$b){ return $a[5]<$b[5]||$a[5]==$b[5]&&$a[0]>$b[0]; });
                        for($i=0;$i<count($row);$i++){
                            if($row[$i][7]=="1"){
                                ?>
                                <tr>
                                    <td>
                                        <table class="ctable">
                                            <tr>
                                                <td class="coffee"><?php echo("商品名稱".$row[$i][2]) ?></td>
                                                <td class="coffee"><?php echo("費用".$row[$i][3]) ?></td>
                                            </tr>
                                            <tr>
                                                <td class="coffee" rowspan="3"><img src="<?= $row[$i][1] ?>" alt="圖片" width="200px" height="175px"></td>
                                                <td class="coffee"><?php echo("商品簡介".$row[$i][6]) ?></td>
                                            </tr>
                                            <tr>
                                                <td class="coffee"><?php echo("發佈日期".$row[$i][5]) ?></td>
                                            </tr>
                                            <tr>
                                                <td class="coffee"><?php echo("相關連結".$row[$i][4]) ?></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <?php
                            }else{
                                ?>
                                <tr>
                                    <td>
                                        <table class="ctable">
                                            <tr>
                                                <td class="coffee" rowspan="3"><img src="<?= $row[$i][1] ?>" alt="圖片" width="200px" height="175px"></td>
                                                <td class="coffee"><?php echo("商品名稱".$row[$i][2]) ?></td>
                                            </tr>
                                            <tr>
                                                <td class="coffee"><?php echo("商品簡介".$row[$i][6]) ?></td>
                                            </tr>
                                            <tr>
                                                <td class="coffee"><?php echo("發佈日期".$row[$i][5]) ?></td>
                                            </tr>
                                            <tr>
                                                <td class="coffee"><?php echo("相關連結".$row[$i][4]) ?></td>
                                                <td class="coffee"><?php echo("費用".$row[$i][3]) ?></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                    ?>
                </table><br>
            </div>
            <?php
        }
    ?>
</body>
</html>
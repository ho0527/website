<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>咖啡商品展示系統</title>
    <link rel="stylesheet" href="index.css">
    <style>
        .main{
            width: 75%;
            height: 650px;
            max-height: 650px;
            overflow-y: auto;
        }
        table{
            width: 90%;
        }
    </style>
</head>
<body>
    <?php
        include("link.php");
        if(!isset($_SESSION["data"])){ header("location:index.php"); }
        unset($_SESSION["pedit"]);
        if($_SESSION["permission"]=="管理者"){
            ?>
            <h1>咖啡商品展示系統</h1>
            <input type="button" class="button selt" onclick="location.href='main.php'" value="首頁">
            <input type="button" class="button" onclick="location.href='productindex.php'" value="上架商品">
            <input type="button" class="button" onclick="location.href='admin.php'" value="會員管理">
            <input type="button" class="button" onclick="location.href='link.php?logout='" value="登出">
            <hr>
            <div class="main">
                <div>
                    <form>
                        價格範圍: <input type="number" name="start" value="-1000000000">~
                        <input type="number" name="end" value="100000000">
                        <input type="submit" name="num" value="查尋">
                    </form>
                    <form>
                        關鍵字: <input type="text" name="text">
                        <input type="submit" name="tex" value="查尋">
                    </form>
                </div><br><br>
                <table class="ptable">
                    <?php
                        if(isset($_GET["num"])){
                            $start=$_GET["start"];
                            $end=$_GET["end"];
                            $row=fetchall(query($db,"SELECT*FROM `coffee` WHERE '$start'<=`cost`AND`cost`<='$end'"));
                        }elseif(isset($_GET["tex"])){
                            $type=$_GET["text"];
                            $row=fetchall(query($db,"SELECT*FROM `coffee` WHERE `name`LIKE'%$type%'or`cost`LIKE'%$type%'or`link`LIKE'%$type%'or`date`LIKE'%$type%'or`intr`LIKE'%$type%'"));
                        }else{
                            $row=fetchall(query($db,"SELECT*FROM `coffee`"));
                        }
                        usort($row,function($a,$b){ return $a[5]<$b[5]||($a[5]==$b[5]&&$a[0]<$b[0]); });
                        for($i=0;$i<count($row);$i++){
                            ?>
                            <tr>
                                <td>
                                    <table>
                                        <?php
                                            if($row[$i][7]==1){
                                                ?>
                                                <tr>
                                                    <td class="ctd">商品名稱 <?= $row[$i][2] ?></td>
                                                    <td class="ctd">費用 <?= $row[$i][3] ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="ctd" rowspan="3"><img src="<?= $row[$i][1] ?>" alt="圖片" width="200px" height="175px"></td>
                                                    <td class="ctd">商品簡介 <?= $row[$i][6] ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="ctd">發佈日期 <?= $row[$i][5] ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="ctd">相關連結 <?= $row[$i][4] ?></td>
                                                </tr>
                                                <?php
                                            }else{
                                                ?>
                                                <tr>
                                                    <td class="ctd" rowspan="3"><img src="<?= $row[$i][1] ?>" alt="圖片" width="200px" height="175px"></td>
                                                    <td class="ctd">商品名稱 <?= $row[$i][2] ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="ctd">商品簡介 <?= $row[$i][6] ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="ctd">發佈日期 <?= $row[$i][5] ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="ctd">相關連結 <?= $row[$i][4] ?></td>
                                                    <td class="ctd">費用 <?= $row[$i][3] ?></td>
                                                </tr>
                                                <?php
                                            }
                                        ?>
                                    </table>
                                    <input type="button" class="button" onclick="location.href='edit.php?pedit=<?= $row[$i][0] ?>'" value="修改"><br><br>
                                </td>
                            </tr>
                            <?php
                        }
                    ?>
                </table>
            </div>
            <?php
        }else{
            ?>
            <h1>咖啡商品展示系統</h1>
            <input type="button" class="button selt" onclick="location.href='main.php'" value="首頁">
            <input type="button" class="button" onclick="" value="上架商品">
            <input type="button" class="button" onclick="location.href='link.php?logout='" value="登出">
            <hr>
            <div class="main">
                <div>
                    <form>
                        價格範圍: <input type="number" name="start" value="-1000000000">~
                        <input type="number" name="end" value="100000000">
                        <input type="submit" name="num" value="查尋">
                    </form>
                    <form>
                        關鍵字: <input type="text" name="text">
                        <input type="submit" name="tex" value="查尋">
                    </form>
                </div>
                <table class="ptable">
                    <?php
                        if(isset($_GET["num"])){
                            $start=$_GET["start"];
                            $end=$_GET["end"];
                            $row=fetchall(query($db,"SELECT*FROM `coffee` WHERE '$start'<=`cost`AND`cost`<='$end'"));
                        }elseif(isset($_GET["tex"])){
                            $type=$_GET["text"];
                            $row=fetchall(query($db,"SELECT*FROM `coffee` WHERE `name`LIKE'%$type%'or`cost`LIKE'%$type%'or`link`LIKE'%$type%'or`date`LIKE'%$type%'or`intr`LIKE'%$type%'"));
                        }else{
                            $row=fetchall(query($db,"SELECT*FROM `coffee`"));
                        }
                        usort($row,function($a,$b){ return $a[5]<$b[5]||($a[5]==$b[5]&&$a[0]<$b[0]); });
                        for($i=0;$i<count($row);$i++){
                            ?>
                            <tr>
                                <td>
                                    <table>
                                        <?php
                                            if($row[$i][7]==1){
                                                ?>
                                                <tr>
                                                    <td class="ctd">商品名稱 <?= $row[$i][2] ?></td>
                                                    <td class="ctd">費用 <?= $row[$i][3] ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="ctd" rowspan="3"><img src="<?= $row[$i][1] ?>" alt="圖片" width="200px" height="175px"></td>
                                                    <td class="ctd">商品簡介 <?= $row[$i][6] ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="ctd">發佈日期 <?= $row[$i][5] ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="ctd">相關連結 <?= $row[$i][4] ?></td>
                                                </tr>
                                                <?php
                                            }else{
                                                ?>
                                                <tr>
                                                    <td class="ctd" rowspan="3"><img src="<?= $row[$i][1] ?>" alt="圖片" width="200px" height="175px"></td>
                                                    <td class="ctd">商品名稱 <?= $row[$i][2] ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="ctd">商品簡介 <?= $row[$i][6] ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="ctd">發佈日期 <?= $row[$i][5] ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="ctd">相關連結 <?= $row[$i][4] ?></td>
                                                    <td class="ctd">費用 <?= $row[$i][3] ?></td>
                                                </tr>
                                                <?php
                                            }
                                        ?>
                                    </table><br><br>
                                </td>
                            </tr>
                            <?php
                        }
                    ?>
                </table>
            </div>
            <?php
        }
    ?>
</body>
</html>
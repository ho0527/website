<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>咖啡商品展示系統</title>
    <link rel="stylesheet" href="index.css">
    <style>
        .main{
            width: 75%;
        }
        table{
            width: 90%;
        }
    </style>
</head>
<body>
    <?php
        include("link.php");
        if(!isset($_SESSION["data"])||$_SESSION["permission"]!="管理者"){ header("location:main.php"); }
        ?>
        <h1>咖啡商品展示系統</h1>
        <input type="button" class="button selt" onclick="location.href='main.php'" value="首頁">
        <input type="button" class="button" onclick="location.href='productindex.php'" value="上架商品">
        <input type="button" class="button" onclick="location.href='admin.php'" value="會員管理">
        <input type="button" class="button" onclick="location.href='link.php?logout='" value="登出">
        <hr>
        <input type="button" class="button" onclick="location.href='productindex.php'" value="上架商品">
        <input type="button" class="button" onclick="location.href='productinput.php'" value="填寫資料">
        <input type="button" class="button selt" onclick="location.href='productperview.php'" value="預覽">
        <input type="button" class="button" onclick="location.href='productsubmit.php'" value="確定送出">
        <br><br>
        <div class="main">
            <h2>預覽</h2><br>
            <table class="ptable">
                <tr>
                    <td>
                        <table>
                            <?php
                                if($_SESSION["val"]=="1"){
                                    ?>
                                    <tr>
                                        <td class="ctd">商品名稱 <?= @$_SESSION["name"] ?></td>
                                        <td class="ctd">費用 <?= @$_SESSION["cost"] ?></td>
                                    </tr>
                                    <tr>
                                        <td class="ctd" rowspan="3"><img src="<?= @$_SESSION["picture"] ?>" alt="圖片" width="200px" height="175px"></td>
                                        <td class="ctd">商品簡介 <?= @$_SESSION["intr"] ?></td>
                                    </tr>
                                    <tr>
                                        <td class="ctd">發佈日期 (發佈後產生)</td>
                                    </tr>
                                    <tr>
                                        <td class="ctd">相關連結 <?= @$_SESSION["link"] ?></td>
                                    </tr>
                                    <?php
                                }else{
                                    ?>
                                    <tr>
                                        <td class="ctd" rowspan="3"><img src="<?= @$_SESSION["picture"] ?>" alt="圖片" width="200px" height="175px"></td>
                                        <td class="ctd">商品名稱 <?= @$_SESSION["name"] ?></td>
                                    </tr>
                                    <tr>
                                        <td class="ctd">商品簡介 <?= @$_SESSION["intr"] ?></td>
                                    </tr>
                                    <tr>
                                        <td class="ctd">發佈日期 (發佈後產生)</td>
                                    </tr>
                                    <tr>
                                        <td class="ctd">相關連結 <?= @$_SESSION["link"] ?></td>
                                        <td class="ctd">費用 <?= @$_SESSION["cost"] ?></td>
                                    </tr>
                                    <?php
                                }
                            ?>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
    <?php
        if(isset($_GET["val"])){
            if($_GET["val"]=="1"||$_GET["val"]=="2"){
                $_SESSION["val"]=$_GET["val"];
            }
            ?><script>location.href="productperview.php"</script><?php
        }
    ?>
</body>
</html>
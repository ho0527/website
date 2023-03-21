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
        }
    </style>
</head>
<body>
    <?php
        include("link.php");
        if(!isset($_SESSION["data"])||$_SESSION["permission"]!="管理者"){ header("location:index.php"); }
    ?>
        <h1>咖啡商品展示系統</h1>
        <input type="button" class="but" onclick="location.href='main.php'" value="首頁">
        <input type="button" class="but selt" onclick="location.href='productindex.php'" value="上架商品">
        <input type="button" class="but" onclick="location.href='admin.php'" value="會員管理">
        <input type="button" class="but" onclick="location.href='link.php?logout='" value="登出">
        <hr>
        <input type="button" class="but" onclick="location.href='productindex.php'" value="選擇版型">
        <input type="button" class="but" onclick="location.href='productinput.php'" value="填寫資料">
        <input type="button" class="but selt" onclick="location.href='productperview.php'" value="預覽">
        <input type="button" class="but" onclick="location.href='productsubmit.php'" value="確定送出"><br><br>
        <div class="main">
        <h2>預覽</h2>
            <?php
                if(@$_SESSION["val"]=="1"){
                    ?>
                    <tr>
                        <td>
                            <table class="ctable">
                                <tr>
                                    <td class="coffee"><?php echo("商品名稱".@$_SESSION["name"]) ?></td>
                                    <td class="coffee"><?php echo("費用".@$_SESSION["cost"]) ?></td>
                                </tr>
                                <tr>
                                    <td class="coffee" rowspan="3"><img src="<?= @$_SESSION["picture"] ?>" alt="圖片" width="200px" height="175px"></td>
                                    <td class="coffee"><?php echo("商品簡介".@$_SESSION["intr"]) ?></td>
                                </tr>
                                <tr>
                                    <td class="coffee"><?php echo("發佈日期(發布後產生)") ?></td>
                                </tr>
                                <tr>
                                    <td class="coffee"><?php echo("相關連結".@$_SESSION["link"]) ?></td>
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
                                    <td class="coffee" rowspan="3"><img src="<?= @$_SESSION["picture"] ?>" alt="圖片" width="200px" height="175px"></td>
                                </tr>
                                <tr>
                                    <td class="coffee"><?php echo("商品名稱".@$_SESSION["name"]) ?></td>
                                    <td class="coffee"><?php echo("商品簡介".@$_SESSION["intr"]) ?></td>
                                </tr>
                                <tr>
                                    <td class="coffee"><?php echo("發佈日期(發布後產生)") ?></td>
                                </tr>
                                <tr>
                                    <td class="coffee"><?php echo("相關連結".@$_SESSION["link"]) ?></td>
                                    <td class="coffee"><?php echo("費用".@$_SESSION["cost"]) ?></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <?php
                }
            ?>
    <?php
        if(isset($_GET["val"])){
            $_SESSION["val"]=$_GET["val"];
            ?><script>location.href="productperview.php"</script><?php
        }
    ?>
</body>
</html>
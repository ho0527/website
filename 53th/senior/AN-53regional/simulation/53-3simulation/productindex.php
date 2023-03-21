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
        if(!isset($_SESSION["val"])){ $_SESSION["val"]="1"; }
    ?>
        <h1>咖啡商品展示系統</h1>
        <input type="button" class="but" onclick="location.href='main.php'" value="首頁">
        <input type="button" class="but selt" onclick="location.href='productindex.php'" value="上架商品">
        <input type="button" class="but" onclick="location.href='admin.php'" value="會員管理">
        <input type="button" class="but" onclick="location.href='link.php?logout='" value="登出">
        <hr>
        <input type="button" class="but" onclick="location.href='newproduct.php'" value="新增版型">
        <input type="button" class="but selt" onclick="location.href='productindex.php'" value="選擇版型">
        <input type="button" class="but" onclick="check('productinput.php')" value="填寫資料">
        <input type="button" class="but" onclick="check('productperview.php')" value="預覽">
        <input type="button" class="but" onclick="check('productsubmit.php')" value="確定送出"><br><br>
        <div class="main">
            <h2>選擇版型</h2>
            <table class="ptable">
                <tr>
                    <td>
                        <table class="ctable" id="1">
                            <tr>
                                <td class="coffee">商品名稱</td>
                                <td class="coffee">費用</td>
                            </tr>
                            <tr>
                                <td class="coffee" rowspan="3">圖片</td>
                                <td class="coffee">商品簡介</td>
                            </tr>
                            <tr>
                                <td class="coffee">發佈日期</td>
                            </tr>
                            <tr>
                                <td class="coffee">相關連結</td>
                            </tr>
                        </table>
                    </td>
                </tr>
                </table><br><br>
            <table class="ptable">
                <tr>
                    <td>
                        <table class="ctable" id="2">
                            <tr>
                                <td class="coffee" rowspan="3">圖片</td>
                                <td class="coffee">商品名稱</td>
                            </tr>
                            <tr>
                                <td class="coffee">商品簡介</td>
                            </tr>
                            <tr>
                                <td class="coffee">發佈日期</td>
                            </tr>
                            <tr>
                                <td class="coffee">相關連結</td>
                                <td class="coffee">費用</td>
                            </tr>
                        </table>
                    </td>
                </tr>
        </table>
    </div>
    <script src="product.js"></script>
    <script>
        document.getElementById("<?= $_SESSION["val"] ?>").style.backgroundColor="rgb(255, 255, 175)"
    </script>
</body>
</html>
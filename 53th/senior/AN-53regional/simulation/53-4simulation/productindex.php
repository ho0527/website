<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>咖啡商品展示系統</title>
    <link rel="stylesheet" href="index.css">
    <style>
        .main{
            width: 75%;
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
        if(!isset($_SESSION["data"])||$_SESSION["permission"]!="管理者"){ header("location:main.php"); }
        if(!isset($_SESSION["val"])){ $_SESSION["val"]=1; }
        ?>
        <h1>咖啡商品展示系統</h1>
        <input type="button" class="button selt" onclick="location.href='main.php'" value="首頁">
        <input type="button" class="button" onclick="location.href='productindex.php'" value="上架商品">
        <input type="button" class="button" onclick="location.href='admin.php'" value="會員管理">
        <input type="button" class="button" onclick="location.href='link.php?logout='" value="登出">
        <hr>
        <input type="button" class="button" onclick="newproduct()" value="新增版型">
        <input type="button" class="button selt" onclick="location.href='productindex.php'" value="上架商品">
        <input type="button" class="button" onclick="check('productinput.php')" value="填寫資料">
        <input type="button" class="button" onclick="check('productperview.php')" value="預覽">
        <input type="button" class="button" onclick="check('productsubmit.php')" value="確定送出">
        <br><br>
        <div class="main">
            <h2>上架商品</h2><br>
            <table class="ptable">
                <tr>
                    <td>
                        <table class="ctable mag" id="1">
                            <tr>
                                <td class="ctd">商品名稱</td>
                                <td class="ctd">費用</td>
                            </tr>
                            <tr>
                                <td class="ctd" rowspan="3">圖片</td>
                                <td class="ctd">商品簡介</td>
                            </tr>
                            <tr>
                                <td class="ctd">發佈日期</td>
                            </tr>
                            <tr>
                                <td class="ctd">相關連結</td>
                            </tr>
                        </table>           
                    </td>
                </tr>
                <tr>
                    <td>
                        <table class="ctable" id="2">
                            <tr>
                                <td class="ctd" rowspan="3">圖片</td>
                                <td class="ctd">商品名稱</td>
                            </tr>
                            <tr>
                                <td class="ctd">商品簡介</td>
                            </tr>
                            <tr>
                                <td class="ctd">發佈日期</td>
                            </tr>
                            <tr>
                                <td class="ctd">相關連結</td>
                                <td class="ctd">費用</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table><br><br>
            <div id="newproduct" style="width:90%;margin:0px auto;"></div>
        </div>
    <?php
        if(isset($_GET["val"])){
            if($_GET["val"]=="1"||$_GET["val"]=="2"){
                $_SESSION["val"]=$_GET["val"];
            }
            ?><script>location.href="productindex.php"</script><?php
        }
    ?>
    <script src="product.js"></script>
    <script>
        document.getElementById("<?= $_SESSION["val"] ?>").style.backgroundColor="rgb(255, 255, 153)"
    </script>
</body>
</html>
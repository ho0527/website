<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>電子競技網站管理</title>
        <link rel="stylesheet" href="index.css">
    </head>
    <body>
        <?php
            include("link.php");
            if(!isset($_SESSION["data"])){ header("location:index.php"); }
        ?>
        <div class="navigationbar">
            <div class="maintitle">電子競技網站管理-選擇版型</div>
            <div class="navigationbarbuttondiv">
                <input type="button" class="navigationbarbutton" onclick="location.href='main.php'" value="首頁">
                <input type="button" class="navigationbarbutton selectbutton" onclick="location.href='productindex.php'" value="電競活動管理精靈">
                <input type="button" class="navigationbarbutton" onclick="location.href='search.php'" value="查尋">
                <input type="button" class="navigationbarbutton" onclick="location.href='admin.php'" value="會員管理">
                <input type="button" class="navigationbarbutton" onclick="location.href='link.php?logout='" value="登出">
            </div>
        </div>
        <div class="productbar">
            <div class="center">
                <input type="button" class="navigationbarbutton selectbutton" onclick="location.href='productindex.php'" value="選擇版型">
                <input type="button" class="navigationbarbutton" onclick="location.href='productinput.php'" value="填寫資料">
                <input type="button" class="navigationbarbutton" onclick="location.href='productpreview.php'" value="預覽">
                <input type="button" class="navigationbarbutton" onclick="location.href='productsumbit.php'" value="確定送出">
            </div>
        </div>
        <div class="mainbody">
            <table class="producttable">
                <tr>
                    <td>
                        <table class="coffeetable">
                            <tr>
                                <td class="coffee"></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
    </body>
</html>
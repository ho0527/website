<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>翻牌配對驗證模組</title>
        <link rel="stylesheet" href="index.css">
    </head>
    <body>
        <?php
            include("link.php");
            if(!isset($_SESSION["data"])){ header("location:index.php"); }
        ?>
        <h1>電子競技網站管理</h1>
        <input type="button" class="button selectbutton" onclick="location.href='main.php'" value="首頁">
        <input type="button" class="button" onclick="location.href='productindex.php'" value="電競活動管理精靈">
        <input type="button" class="button" onclick="location.href='admin.php'" value="會員管理">
        <input type="button" class="button logout" onclick="location.href='link.php?logout='" value="登出">
        <hr>
        <div class="productmaindiv">
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
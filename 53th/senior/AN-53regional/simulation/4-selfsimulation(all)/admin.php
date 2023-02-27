<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <?php
        include("link.php");
        if(!isset($_SESSION["data"])){ header("location:index.php"); }
        ?>
        <div class="head">
            <form action="">
                <div class="title">咖啡商品展示系統-會員管理</div>
                <div class="hbut">
                    <input type="button" class="headbut" onclick="location.href='edit.php'" value="新增使用者">
                    <input type="button" class="headbut" onclick="location.href='main.php'" value="首頁">
                    <input type="button" class="headbut" onclick="location.href='productindex.php'" value="上架商品">
                    <input type="button" class="headbut" onclick="location.href='search.php'" value="查詢">
                    <input type="button" class="headbut selt" onclick="location.href='admin.php'" value="會員管理">
                    <input type="submit" class="headbut" name="logout" value="登出">
                    <input type="text" name="search" id="" placeholder="查詢">
                    <input type="submit" name="submit" value="送出">
                </div>
            </form>
        </div>
        <div class="top">
            <table>
                <tr>
                    <td class="admintd">編號</td>
                    <td class="admintd">帳號</td>
                    <td class="admintd">密碼</td>
                    <td class="admintd">姓名</td>
                    <td class="admintd">權限</td>
                    <td class="admintd">動作</td>
                    <td class="admintd">時間</td>
                </tr>
                <?php
                    if(isset($_GET["submit"])){
                        
                    }else{

                    }
                ?>
            </table>
        </div>
        <div class="bottom">
            <table>
                <tr>
                    <td class="admintd">編號</td>
                    <td class="admintd">帳號</td>
                    <td class="admintd">密碼</td>
                    <td class="admintd">姓名</td>
                    <td class="admintd">權限</td>
                </tr>
                <?php
                    if(isset($_GET["submit"])){
                        
                    }else{

                    }
                ?>
            </table>
        </div>
        <?php

    ?>
</body>
</html>
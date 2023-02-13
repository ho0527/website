<!DOCTYPE html>
<html>
   <head>
      <meta charset="UTF-8">
      <title>管理者專區</title>
      <link href="index.css" rel="stylesheet">
   </head>
   <body>
        <div class="navigationbar">
            <div class="navigationbardiv">
                <form>
                    咖啡商品展示系統-&nbsp&nbsp預覽&nbsp&nbsp
                    <input type="button" class="adminbutton" onclick="location.href='signupedit.php'" value="新增">
                    <input type="button" class="adminbutton" onclick="location.href='main.php'" value="首頁">
                    <input type="button" class="adminbutton selectbut" onclick="location.href='productindex.php'" value="上架商品">
                    <input type="button" class="adminbutton" onclick="location.href='search.php'" value="查詢">
                    <input type="button" class="adminbutton" onclick="location.href='manage.php'" value="會員管理">
                    <input type="submit" class="adminbutton" name="logout" value="登出">
                </form>
            </div>
        </div>
        <div class="productbar">
           <div class="productbardiv">
                <input type="button" class="productbutton" onclick="location.href='productindex.php'" value="選擇版型">
                <input type="button" class="productbutton" onclick="location.href='productinput.php'" value="填寫資料">
                <input type="button" class="productbutton selectbut" onclick="location.href='productpreview.php'" value="預覽">
                <input type="button" class="productbutton" onclick="location.href='productsubmit.php'" value="確定送出">
           </div>
        </div>
        <?php
            include("link.php");
            @$name=$_SESSION["name"];
            @$introduction=$_SESSION["introduction"];
            @$cost=$_SESSION["cost"];
            @$link=$_SESSION["link"];
            @$val=$_SESSION["val"];
            @$picture=$_SESSION["picture"];
            if($val){
                if($val==1){
                    ?>
                    <div class="version" style="position: relative;left: 38%;top:200px;">
                        <table class="producttable">
                            <tr>
                                <td class="coffeedata">商品名稱: <?= @$name ?></td>
                                <td class="coffeedata">費用: <?= @$cost ?></td>
                            </tr>
                            <tr>
                                <td class="coffeedata" rowspan="4">圖片: <img src="<?= @$picture ?>" width="120px"></td>
                                <td class="coffeedata" rowspan="2">商品簡介: <?= @$introduction ?></td>
                            </tr>
                            <tr></tr>
                            <tr>
                                <td class="coffeedata">發佈日期: (發布後產生)</td>
                            </tr>
                            <tr>
                                <td class="coffeedata">相關連結: <?= @$link ?></td>
                            </tr>
                        </table>
                    </div>
                    <?php
                }else{
                    ?>
                    <div class="version" style="position: relative;left: 38%;">
                        <table class="producttable">
                            <tr>
                                <td class="coffeedata" rowspan="4">圖片: <img src="<?= @$picture ?>" width="120px"></td>
                                <td class="coffeedata">商品名稱: <?= @$a[$i][2] ?></td>
                            </tr>
                            <tr>
                                <td class="coffeedata" rowspan="2">商品簡介: <?= @$introduction ?></td>
                            </tr>
                            <tr></tr>
                            <tr>
                                <td class="coffeedata">發佈日期: (發布後產生)</td>
                            </tr>
                            <tr>
                                <td class="coffeedata">費用: <?= @$cost ?></td>
                                <td class="coffeedata">相關連結: <?= @$link ?></td>
                            </tr>
                        </table>
                    </div>
                    <?php
                }
            }else{
                ?><script>alert("請選擇版型!");location.href="productindex.php"</script><?php
            }
        ?>
   </body>
</html>
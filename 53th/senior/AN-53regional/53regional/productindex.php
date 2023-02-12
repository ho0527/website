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
               咖啡商品展示系統-選擇版型
               <input type="button" class="adminbutton" onclick="location.href='signup.php'" value="新增">
               <input type="button" class="adminbutton" onclick="location.href='adminWelcome.php'" value="首頁">
               <input type="button" class="adminbutton selectbut" onclick="location.href='productindex.php'" value="上架商品">
               <input type="button" class="adminbutton" onclick="location.href='manage.php'" value="會員管理">
               <input type="submit" class="adminbutton" name="logout" value="登出">
            </form>
         </div>
      </div>
      <div class="productbar">
         <div class="productbardiv">
            <input type="button" class="productbutton selectbut" onclick="location.href='productindex.php'" value="選擇版型">
            <input type="button" class="productbutton" onclick="data()" value="填寫資料">
            <input type="button" class="productbutton" onclick="location.href='productpreview.php'" value="預覽">
            <input type="button" class="productbutton" onclick="nono()" value="確定送出">
         </div>
      </div>
      <div class="version" id="version1" style="top: 300px;left:225px;">
         <table class="producttable">
            <tr>
               <td class="coffeedata">商品名稱</td>
               <td class="coffeedata">費用:0000</td>
            </tr>
            <tr>
               <td class="coffeedata" rowspan="4">圖片:</td>
               <td class="coffeedata" rowspan="2">商品簡介:</td>
            </tr>
            <tr></tr>
            <tr>
               <td class="coffeedata">發佈日期:</td>
            </tr>
            <tr>
               <td class="coffeedata">相關連結:</td>
            </tr>
         </table>
      </div>
      <div class="version" id="version2" style="top: 300px;right:225px;">
         <table class="producttable">
            <tr>
               <td class="coffeedata" rowspan="4">圖片:</td>
               <td class="coffeedata">商品名稱</td>
            </tr>
            <tr>
               <td class="coffeedata" rowspan="2">商品簡介:</td>
            </tr>
            <tr></tr>
            <tr>
               <td class="coffeedata">發佈日期:</td>
            </tr>
            <tr>
               <td class="coffeedata">相關連結:</td>
               <td class="coffeedata">費用:0000</td>
            </tr>
         </table>
      </div>
      <?php
         include("link.php");
         if(isset($_GET["val"])){
            if(isset($_SESSION["val"])){
               header("location:productinput.php");
            }else{
               ?><script>alert("請先選擇版型!");location.href="productindex.php"</script><?php
            }
         }
      ?>
      <script src="productindex.js"></script>
   </body>
</html>
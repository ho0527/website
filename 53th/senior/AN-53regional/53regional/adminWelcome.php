<!DOCTYPE html>
<html>
   <head>
      <meta charset="UTF-8">
      <title>管理者專區</title>
      <link href="index.css" rel="stylesheet">
   </head>
   <body>
      <?php
         include("link.php");
         include("def.php");
      ?>
      <div class="navigationbar">
         <form class="navigationbardiv">
            咖啡商品展示系統-&nbsp&nbsp首頁&nbsp&nbsp
            <input type="button" class="adminbutton" onclick="location.href='signup.php'" value="新增">
            <input type="button" class="adminbutton selectbut" onclick="location.href='adminWelcome.php'" value="首頁">
            <input type="button" class="adminbutton" onclick="location.href='productindex.php'" value="上架商品">
            <input type="button" class="adminbutton" onclick="location.href='manage.php'" value="會員管理">
            <input type="submit" class="adminbutton" name="logout" value="登出">
         </form>
      </div>
      <table class="maintable">
         <?php
            product(query($db,"SELECT*FROM `coffee`"),0);
         ?>
      </table>
   </body>
</html>
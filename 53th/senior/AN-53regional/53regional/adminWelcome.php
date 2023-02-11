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
         include("admindef.php");
      ?>
      <table>
         <tr>
            <td class="admin-title">
               <form>
                  <div class="navigationbar">
                     <div class="navigationbardiv">
                        咖啡商品展示系統-&nbsp&nbsp首頁&nbsp&nbsp
                        <input type="button" class="adminbutton" onclick="location.href='signup.php'" value="新增">
                        <input type="button" class="adminbutton selectbut" onclick="location.href='adminWelcome.php'" value="首頁">
                        <input type="button" class="adminbutton" onclick="location.href='productindex.php'" value="上架商品">
                        <input type="button" class="adminbutton" onclick="location.href='manage.php'" value="會員管理">
                        <input type="submit" class="adminbutton" name="logout" value="登出">
                     </div>
                  </div>
               </form>
            </td>
         </tr>
         <tr>
            <td>
               <table class="maintable">
                  <?php
                     product($db);
                  ?>
               </table>
            </td>
         </tr>
      </table>
      <?php
         @$data=$_SESSION["data"];
         if(isset($_GET["logout"])){
            $row=fetch(query($db,"SELECT*FROM `user` WHERE `number`='$data'"));
            if(isset($data)){
               query($db,"INSERT INTO `data`(`number`, `username`, `password`,`name`,`permission`, `time`, `move`) VALUES ('$row[4]','$row[1]','$row[2]','$row[3]','$row[5]','$time','登出成功')");
               ?><script>alert("登出成功!");location.href="index.php"</script><?php
               session_unset();
            }else{
               query($db,"INSERT INTO `data`(`number`, `username`, `password`,`name`,`permission`, `time`, `move`) VALUES ('未知','','','','','','登出成功')");
               ?><script>alert("登出成功!");location.href="index.php"</script><?php
               session_unset();
            }
         }
      ?>
   </body>
</html>
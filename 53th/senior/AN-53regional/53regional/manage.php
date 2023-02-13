<!DOCTYPE html>
<html>
   <head>
      <meta charset="UTF-8">
      <title>管理者專區</title>
      <link href="index.css" rel="Stylesheet">
   </head>
   <body>
      <div class="navigationbar">
         <form class="navigationbardiv">
            咖啡商品展示系統-會員管理
            <input type="button" class="adminbutton" onclick="location.href='signupedit.php'" value="新增">
            <input type="button" class="adminbutton" onclick="location.href='main.php'" value="首頁">
            <input type="button" class="adminbutton" onclick="location.href='productindex.php'" value="上架商品">
            <input type="button" class="adminbutton" onclick="location.href='search.php'" value="查詢">
            <input type="button" class="adminbutton selectbut" onclick="location.href='manage.php'" value="會員管理">
            <input type="submit" class="adminbutton" name="logout" value="登出">
         </form>
      </div>
      <table>
         <form>
            <tr>
               <td class="admintable">編號<input type="submit" name="num-up-down" id="num-up-down" value="升冪"></td>
               <td class="admintable">使用者帳號<input type="submit" name="user-up-down" id="user-up-down" value="升冪"></td>
               <td class="admintable">密碼<input type="submit" name="code-up-down" id="code-up-down" value="升冪"></td>
               <td class="admintable">名稱<input type="submit" name="name-up-down" id="name-up-down" value="升冪"></td>
               <td class="admintable">權限</td>
               <td class="admintable">時間</td>
               <td class="admintable">動作</td>
            </tr>
            <?php
               include("link.php");
               if(isset($_SESSION["type"])){
                  $type=$_SESSION["type"];
                  if($type==""){
                     unset($_SESSION["type"]);
                     header("location:manage.php");
                  }else{
                     $data=query($db,"SELECT*FROM `data` WHERE `number`LIKE'%$type%' or `username`LIKE'%$type%' or `password`LIKE'%$type%' or `name`LIKE'%$type%' or `permission`LIKE'%$type%' or `time`LIKE'%$type%' or `move`LIKE'%$type%'");
                     issetgetupdown($data);
                  }
               }else{
                  $data=query($db,"SELECT*FROM `data`");
                  issetgetupdown($data);
               }
            ?>
         </form>
      </table>
      <table class="timer">
         <tr>
            <td rowspan="2" class="timertd">
               <input type="text" class="timerbox" id="timer" value="<?= @$_SESSION["timer"] ?>" readonly>
            </td>
            <td class="timertd">
               <form>
                  <input type="text" id="changetimer" class="timersec" name="changetimer" value="<?= @$_SESSION["timer"] ?>" placeholder="秒">
                  <input type="submit" name="changetimersubmit" value="送出">
               </form>
            </td>
         </tr>
         <tr>
            <td class="timertd">
               <button class="timeerbutton" id="resetbutton">重新計時</button>
            </td>
         </tr>
      </table>
      <div class="lightboxdiv" id="ask">
         <div class="mask"></div>
         <div class="body">
            是否繼續操作?<br>
            <input type="button" class="close" id="yes" value="Yes">
            <input type="button" class="close" id="no" value="no">
         </div>
      </div>
      <?php
         if(isset($_GET["enter"])){
            $_SESSION["type"]=$_GET["search"];
            ?><script>location.href="manage.php"</script><?php
         }
         if(isset($_GET["del"])){
            $number=$_GET["del"];
            $user=query($db,"SELECT*FROM `user` WHERE `number`='$number'");
            if($row=fetch($user)){
               query($db,"DELETE FROM `user` WHERE `number`='$number'");
               ?><script>alert("刪除成功!");location.href="manage.php"</script><?php
            }else{
               ?><script>alert("帳號已被刪除!");location.href="manage.php"</script><?php
            }
         }
         if(isset($_GET["changetimersubmit"])){
            $_SESSION["timer"]=$_GET["changetimer"];
            ?><script>alert("更改成功!");location.href="manage.php"</script><?php
         }
      ?>
      <script src="admin.js"></script>
   </body>
</html>
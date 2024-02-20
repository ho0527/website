<!-- html架構不解釋 -->
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <title>新增留言</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <img class="img" src="banner.png" alt="">
        <div class="footertop">
            <a class="hover page" onclick="location.href='message.php'">
                <p class="bar">|</p>玩家留言
            </a>
            <a class="hover" onclick="location.href='join.php'">
                <p class="hbar">|</p>玩家參賽
            </a>
            <a class="hover" onclick="location.href='login.php'">
                <p class="hbar">|</p>網站管理
            </a><br><br>
        </div><br><br>
        <div class="box">
            <h2>玩家留言-新增<button onclick="location.href='message.php'">回留言列表</button><br></h2>
            <!-- 表單不解釋 -->
            <form action="messageadd.php" method="post" enctype="multipart/form-data">
                <div class="div">姓名</div><input type="text" class="input" name="username"><br><br>
                <div class="div">E-mail</div><input type="text" placeholder="需要填一個@和一個." class="input" name="email"><br><br>
                <div class="div">電話</div><input type="text" placeholder="只能填0~9" class="input" name="phone"><br><br>
                <div class="div">留言內容</div><input type="text" class="input" name="comment">
                <input type="file" name="file" id="" accept="image/*"><br><br>
                留言序號:<input type="text" name="number"><br><br>
                <button type="submit" name="submit">送出</button>
                <button type="reset">重設</button>
                <?php
                    // 當送出後
                    if(isset($_POST["submit"])){
                        $db=new PDO("mysql:host=localhost;dbname=52;charset=UTF8;","admin","1234"); // 資料庫連接
                        // 定義變數 START
                        $username=$_POST["username"];
                        $email=$_POST["email"];
                        $phone=$_POST["phone"];
                        $comment=$_POST["comment"];
                        $number=$_POST["number"];
                        $picture="image/".$_FILES["file"]["name"]; // $FILES 是獲取FILES元素(像_POST、_GET) 而name是他的一個值 用來存檔名
                        // 定義變數 END
                        if(preg_match("/^.+\@.+\..+((\..+)+)?$/",$email)){ // email正則不解釋
                            if(preg_match("/^[0-9]+((\-[0-9]+)+)?$/",$phone)){  // 電話正則不解釋
                                // 用來判斷檔名是否重複，如果重複則在檔名前面加上一個數字，例如image/1_test.png
                                if(!empty($picture)){ // 偵測有沒有上傳picture，如果有就將picture存檔，如果沒有就不存檔
                                    $i=0; // 檔案編號預設為0
                                    // 如果有重複檔名，就要加上一個數字，例如image/1_test.png 直到沒有該檔為止
                                    while(file_exists($picture)){
                                        $i=$i+1;
                                        $picture="image/".$i."_".$_FILES["file"]["name"];
                                    }
                                    // 上傳檔案函數 tmp_name是一個臨時文件名,picture為檔案路徑
                                    move_uploaded_file($_FILES["file"]["tmp_name"],$picture);
                                    ?><script>alert("新增資料成功");location.href="message.php"</script><?php
                                    $db->query("INSERT INTO `message`(`username`,`email`,`phone`,`msg`,`num`,`imgPath`) VALUES('$username','$email','$phone','$comment','$number','$picture')"); // 送出
                                }
                                // !!! 註: 理論上這裡他寫錯了 這樣有上傳圖黨會沒偵測留言序號 要把上方的if函式丟到此if內 !!!
                                if(preg_match("/[0-9]{4}/",$number)){
                                    ?><script>alert("新增資料成功");location.href="message.php"</script><?php
                                    $db->query("INSERT INTO `message`(`username`,`email`,`phone`,`msg`,`num`) VALUES('$username','$email','$phone','$comment','$number')"); // 送出
                                }else{
                                    ?><script>alert("留言序號只能是4位數喔~")</script><?php
                                }
                            }else{
                                ?><script>alert("電話欄位只能填0~9或-號喔~")</script><?php
                            }
                        }else{
                            ?><script>alert("E-mail欄位需要填一個@和一個.喔~")</script><?php
                        }
                    }
                ?>
            </form>
        </div>
    </body>
</html>
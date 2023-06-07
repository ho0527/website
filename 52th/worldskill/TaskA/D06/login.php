<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>資料視覺化</title>
        <link rel="stylesheet" href="index.css">
        <link rel="stylesheet" href="plugin/css/macossection.css">
        <script src="plugin/js/macossection.js"></script>
    </head>
    <body>
        <div class="grid">
            <div class="left">
                <input type="button" onclick="location.href='index.html'" value="Leave Chat">
                <h1>test1</h1>
                <div class="div">使用者列表</div>
                user1<br>
                user2<br>
                user3<br>
                user4<br>
                user5<br>
                user6<br>
                user7<br>
            </div>
            <div class="right macossectiondiv">
                <?php
                    include("link.php");
                    $row=query($db,"SELECT*FROM `log`");
                    for($i=0;$i<count($row);$i=$i+1){
                        ?>
                        <h2><?php echo($row[$i][1]) ?></h2>
                        <p><?php echo($row[$i][2]) ?></p>
                        <?php
                    }
                ?>
            </div>
            <div class="rightright">test1 Hi</div>
            <div class="newchat">
                <form method="POST">
                    <input type="text" class="input" name="input">
                    <input type="submit" class="submit" name="submit">
                </form>
            </div>
        </div>
        <?php
            if(isset($_POST["submit"])){
                $input=$_POST["input"];
                query($db,"INSERT INTO `log`(`username`,`context`)VALUES('test1',?)",[$input]);
                ?><script>location.href="login.php"</script><?php
            }
        ?>
    </body>
</html>
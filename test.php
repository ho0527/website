<!DOCTYPE html>
<html>
<head>
    <title>文章內容</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="post.js"></script>
   
</head>

<body>
    
    <header>
        <h1>每日文章</h1>
    </header>
    
    <main>

        <?php
            session_start();
            require_once 'mysql.inc.php';
            echo "<p>歡迎, " . $_SESSION['username'] . "!</p>";
            

            // 檢查 Session 中是否有 username
            if (isset($_SESSION['username']) && isset($_POST['articleId'])) {
                $logged_in_username = $_SESSION['username'];
                $articleId = $_POST['articleId'];

                // 檢查是否已經收藏過
                $check_duplicate_sql = "SELECT * FROM `posting` WHERE `帳號`='$logged_in_username' AND `類別`='$articleId'";
                $result = mysqli_query($conn, $check_duplicate_sql);
                
                if (mysqli_num_rows($result) > 0) {
                    echo '已經點選過了！';
                } else {
                    $insert_sql = "INSERT INTO `posting` (`帳號`,`類別`) VALUES ('$logged_in_username','$articleId')";

                        if (mysqli_query($conn, $insert_sql)) {
                            
                        } else {
                            echo 'Error inserting record: ' . mysqli_error($conn);
                        }
                }
            }
             
            
        ?>

        <article>
            <h2>#閒聊 大學生的存款</h2>
            <p>想問大家覺得現在大學生至少要有多少存款...</p>
            <button class="collect-btn1" onclick="handleCollect(1)" data-collected="false">喜歡</button>
        </article>

        <article>
            <h2>#八卦 柯震東有女友？！</h2>
            <p>在Threads看到的，這是真假？怎麼都沒新聞 低卡也沒有...</p>
            <button class="collect-btn2" onclick="handleCollect(2)" data-collected="false">喜歡</button>
        </article>
    
    </main>
</body>
</html>


<?php
    session_start();
    if(!isset($_SESSION['passcode'])){ $_SESSION['passcode']=""; };
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>玩家留言</title>
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg justify-content-between navbar-light bg-primary fixed-top">
        <div class="navbar-brand"><img src="logo.png" height="50px" alt=""></div>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="chat.php" class="nav-link active"><p class="line">|</p>玩家留言</a>
            </li>
            <li class="nav-item">
                <a href="join.php" class="nav-link"><p class="line" id="nonec">|</p>玩家參賽</a>
            </li>
            <li class="nav-item">
                <a href="m.php" class="nav-link"><p class="line" id="nonec">|</p>網站管理</a>
            </li>
        </ul>
    </nav>
    <img src="banner.png" class="bg-img" alt="">
    <div class="container" id="p1">
        <div class="row">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-title bg-card-g">
                        <div class="row my-2">
                            <input type="button" value="新增留言" id="NewMsg" onclick="apear3()" class="col-2 offset-1 btn btn-secondary">
                            <h1 class="col-6 t-c">玩家留言列表</h1>
                            <input type="button" value="玩家留言管理" id="ControlMsg" class="col-2 btn btn-secondary">
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div>
                                <div>玩家A</div>
                                <div>message</div>
                                <div>time</div>
                                <div>email,tel</div>
                            </div>
                            <div>
                                <form action="edit.php" method="post">
                                    <h3>留言序號</h3>
                                    <input type="number" name="snum" id="snum">
                                    <input type="submit" name="edit" value="編輯">
                                    <input type="submit" name="del" value="刪除">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container" id="p2">
        <div class="row">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-title bg-card-b">
                        <div class="row my-2">
                            <h1 class="col-6 offset-3 cw t-c">最新消息與賽制公告區塊</h1>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <img src="banner.png" alt="">
                            <img src="banner.png" alt="">
                            <img src="banner.png" alt="">
                            <img src="banner.png" alt="">
                            <img src="banner.png" alt="">
                            <img src="banner.png" alt="">
                            <img src="banner.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- 以上是留言列表 -->
    <!-- 以下是新增留言功能 -->
    <div class="container" id="p3">
        <div class="row">
            <div class="card shadow p-3 col-12">
                <div class="card-title row">
                    <h2 class="col-6 offset-3 t-c">玩家留言-新增</h2>
                    <input type="button" class="btn btn-secondary col-3" onclick="apear12()" value="回留言列表">
                </div>
                <div class="card-body">
                    <div class="row my-5">
                        <div class="col-2 sbd t-c cw bg-b p-1" id="inpblock"><h2>姓名</h2></div>
                        <label class="form-group">
                            <input type="text" class="form-control col-6 offset-4 sbd mt-2" name="" id="inpblocks">
                        </label>
                    </div>
                    <div class="row my-5">
                        <div class="col-2 sbd t-c cw bg-b p-1" id="inpblock"><h2>姓名</h2></div>
                        <label class="form-group">
                            <input type="text" class="form-control col-6 offset-4 sbd mt-2" name="" id="inpblocks">
                        </label>
                    </div>
                    <div class="row my-5">
                        <div class="col-2 sbd t-c cw bg-b p-1" id="inpblock"><h2>姓名</h2></div>
                        <label class="form-group">
                            <input type="text" class="form-control col-6 offset-4 sbd mt-2" name="" id="inpblocks">
                        </label>
                    </div>
                    <div class="row my-5">
                        <div class="col-2 sbd t-c cw bg-b p-1" id="inpblock"><h2>姓名</h2></div>
                        <label class="form-group">
                            <input type="text" class="form-control col-6 offset-4 sbd mt-2" name="" id="inpblockss">
                        </label>
                    </div>
                    <div class="row my-5">
                        <div class="col-2 sbd t-c cw bg-b p-1" id="inpblock"><h2>姓名</h2></div>
                        <label class="form-group">
                            <input type="text" class="form-control col-4 offset-4 sbd mt-2" name="" id="inpblock">
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- 以上是新增留言功能 -->
    <div class="container" id="p4">
        <div class="card shadow p-2">
            <div class="card-head row">
                <h2 class="offset-2 col-8 t-c">玩家留言-編輯</h2>
                <input type="button" class="sbd bg-b col-2 cw" value="回留言列表" onclick="apear12()">
            </div>
        </div>
    </div>
    <!-- 以下是js區塊 -->
    <script>
        function disapear(){
            document.getElementById("p1").style.display="none"
            document.getElementById("p2").style.display="none"
            document.getElementById("p3").style.display="none"
            document.getElementById("p4").style.display="none"
        }
        function apear12(){
            disapear()
            document.getElementById("p1").style.display="block"
            document.getElementById("p2").style.display="block"
        }
        function apear3(){
            disapear()
            document.getElementById("p3").style.display="block"
        }
        function apear4(){
            disapear()
            document.getElementById("p4").style.display="block"
        }
        apear12()
        let passcode="<?= $_SESSION['passcode']; ?>"
        if(passcode==1){
            apear4()
            passcode=""
            console.log(123)
            <?php
                unset($_SESSION['passcode']);
            ?>
        }
    </script>
    <!-- 以上是js區塊 -->
</body>
</html>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>翻牌配對驗證模組</title>
        <link rel="stylesheet" href="index.css">
    </head>
    <body>
        <?php
            include("link.php");
            if(!isset($_SESSION["data"])){ header("location:index.php"); }else{ if($_SESSION["data"]!="a0000"){ header("location:main.php"); } }
        ?>
        <div class="main">
            <h1>翻牌配對驗證模組</h1><hr>
            <?php
                $_SESSION["str"]=[];
                $time=0;
                while(count($_SESSION["str"])<3){
                    $str=range("A","Z")[rand(0,25)];
                    $_SESSION["str"][]=$str;
                    $time=$time+1;
                    for($i=$time;$i<count($_SESSION["str"]);$i=$i+1){
                        if($_SESSION["str"][$i]==$str){
                            array_pop($_SESSION["str"]);
                        }
                    }
                }
                print_r($_SESSION["str"]);
                while(count($_SESSION["str"])<3){
                    $str=range("A","Z")[rand(0,25)];
                    $_SESSION["str"][]=$str;
                    $time=$time+1;
                    for($i=$time;$i<count($_SESSION["str"]);$i=$i+1){
                        if($_SESSION["str"][$i]==$str){
                            array_pop($_SESSION["str"]);
                        }
                    }
                }
                $key1=rand(0,8);
            ?>
            <table class="table mag">
                <tr>
                    <td class="verifytd"></td>
                    <td class="verifytd"></td>
                    <td class="verifytd"></td>
                    <td class="verifytd"></td>
                </tr>
                <tr>
                    <td class="verifytd"></td>
                    <td class="verifytd"></td>
                    <td class="verifytd"></td>
                    <td class="verifytd"></td>
                </tr>
            </table>
            <input type="button" class="button" onclick="location.href='link.php?logout='" value="登出">
            <input type="button" class="button" onclick="location.reload()" value="清除">
            <input type="button" class="button" onclick="showall()" value="全部翻牌">
            <input type="button" class="button" onclick="check()" value="確定">
        </div>
        <script src="verify.js"></script>
    </body>
</html>
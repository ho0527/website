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
            $_SESSION["str"]=[];
            $_SESSION["rand"]=[];
            while(count($_SESSION["str"])<3){
                $str=range("A","Z")[rand(0,25)];
                if($str!="E"){
                    $_SESSION["str"][]=$str;
                    for($i=0;$i<(count($_SESSION["str"])-1);$i=$i+1){
                        if($_SESSION["str"][$i]==$str){
                            array_pop($_SESSION["str"]);
                            break;
                        }
                    }
                }
            }
            $_SESSION["str"][]="E";
            for($i=0;$i<4;$i=$i+1){
                $_SESSION["str"][]=$_SESSION["str"][$i];
            }
            while(count($_SESSION["rand"])<8){
                $rand=rand(0,7);
                $_SESSION["rand"][]=$rand;
                for($i=0;$i<(count($_SESSION["rand"])-1);$i=$i+1){
                    if($_SESSION["rand"][$i]==$rand){
                        array_pop($_SESSION["rand"]);
                        break;
                    }
                }
            }
        ?>
        <div class="main">
            <h1>電子競技網站管理</h1><hr>
            <h2 class="mag">翻牌配對驗證模組</h2>
            <table class="verifytable mag">
                <tr>
                    <td class="verifytd" id="0"><?php echo($_SESSION["str"][$_SESSION["rand"][0]]) ?></td>
                    <td class="verifytd" id="1"><?php echo($_SESSION["str"][$_SESSION["rand"][1]]) ?></td>
                    <td class="verifytd" id="2"><?php echo($_SESSION["str"][$_SESSION["rand"][2]]) ?></td>
                    <td class="verifytd" id="3"><?php echo($_SESSION["str"][$_SESSION["rand"][3]]) ?></td>
                </tr>
                <tr>
                    <td class="verifytd" id="4"><?php echo($_SESSION["str"][$_SESSION["rand"][4]]) ?></td>
                    <td class="verifytd" id="5"><?php echo($_SESSION["str"][$_SESSION["rand"][5]]) ?></td>
                    <td class="verifytd" id="6"><?php echo($_SESSION["str"][$_SESSION["rand"][6]]) ?></td>
                    <td class="verifytd" id="7"><?php echo($_SESSION["str"][$_SESSION["rand"][7]]) ?></td>
                </tr>
            </table>
            <input type="button" class="button" onclick="location.href='link.php?logout='" value="登出">
            <input type="button" class="button" onclick="location.reload()" value="重整">
            <input type="button" class="button" id="open" onclick="showall()" value="全部翻牌">
        </div>
        <script src="verify.js"></script>
    </body>
</html>
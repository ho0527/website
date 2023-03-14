<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Document</title>
        <link rel="stylesheet" href="index.css">
    </head>
    <body>
        <?php
            include("link.php");
            if(!isset($_SESSION["data"])){ header("location:index.php"); }else{ if($_SESSION["data"]!="a0001"){ header("location:main.php"); } }
        ?>
        <div class="main">
            <?php
                $_SESSION["str"]=[];
                print_r($_SESSION["str"]);
                while(count($_SESSION["str"])==3){
                    $str=range("A","Z")[rand(0,25)];
                    echo("in");
                    for($i=0;$i<count($_SESSION["str"]);$i=$i+1){
                        if($_SESSION["str"][$i]!=$str){
                            $_SESSION["str"][]=$str;
                        }
                    }
                    print_r($_SESSION["str"]);
                }
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
            <input type="button" class="button" onclick="allshow()" value="全部翻牌">
            <input type="button" class="button" onclick="check()" value="確定">
        </div>
        <script src="verify.js"></script>
    </body>
</html>
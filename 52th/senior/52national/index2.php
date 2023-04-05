<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Document</title>
        <link rel="stylesheet" href="index.css">
        <style>
            .main{
                font-size: 20px;
                width: 500px;
                height: 175px;
                text-align: center;
            }
        </style>
    </head>
    <body>
        <div class="main">
            <h1>
                <?php
                    $array=["A5","A11","A13","A14","A22","B-1圖","C-美化","D-一集","E-了解indexDb","F12-理解","F13","FA10","青年53區賽-1模組","青年52區賽-美化","青年52區賽-功能重製","青年49區賽-1題","青年51區賽-1","青少52全國-M3","青少52全國-最後核對","chatcom-加密","FB自動發文","FUCK YOU","放假:)))","????"];
                    echo($array[rand(0,count($array)-1)]);
                ?>
            </h1>
            <input type="button" class="reflashbutton" onclick="location.reload()" value="重整">
        </div>
    </body>
</html>
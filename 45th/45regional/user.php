<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>一般會員專區</title>
        <link href="index.css" rel="stylesheet">
        <link rel="stylesheet" href="/website/plugin/css/chrisplugin.css">
        <script src="/website/plugin/js/chrisplugin.js"></script>
    </head>
    <body class="userbody">
        <table>
            <tr>
                <td class="todo" rowspan="2">
                    <div class="sttext todotitle">日工作計畫表</div>
                    <table class="sttable stripe allborder" id="maintable"></table>
                </td>
                <td class="title">一般會員專區</td>
            </tr>
            <tr>
                <td class="user-table4">
                    開始時間: <input type="button" class="table4but" id="updownbutton"><br>
                    處理情形:
                    <select class="table4but" id="dealselect">
                        <option>篩選器</option>
                        <option>未處理</option>
                        <option>處理中</option>
                        <option>已完成</option>
                    </select><br>
                    優先情形:
                    <select class="table4but" id="priorityselect">
                        <option>篩選器</option>
                        <option>普通</option>
                        <option>速件</option>
                        <option>最速件</option>
                    </select><br>
                    <div class="userfunctionbutton">
                        <input type="submit" class="stbutton outline fill" id="selectersubmit" value="確定(篩選器)"><br><br>
                        <input type="button" class="stbutton outline fill" id="newtodo" value="新增todo"><br>
                        <input type="button" class="stbutton outline fill" id="logout" value="登出">
                    </div>
                    <?php
                        if(isset($_GET["preview"])){
                            $id=$_GET["preview"];
                            @$row=query($db,"SELECT*FROM `todo` WHERE `id`='$id'")[0];
                            ?>
                            <div class="div">
                                標題: <?= @$row[1]; ?><br>
                                詳細內容: <?= @$row[7]; ?>
                                <button onclick="location.href='user.php'" id="button4">關閉</button>
                            </div>
                            <?php
                        }
                    ?>
                </td>
            </tr>
        </table>

        <div id="lightbox"></div>

        <script src="user.js"></script>
    </body>
</html>
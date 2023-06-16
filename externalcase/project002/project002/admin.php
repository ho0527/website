<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="index.css">
        <link rel="stylesheet" href="plugin/css/macossection.css">
        <link rel="stylesheet" href="plugin/css/sort.css">
        <script src="plugin/js/macossection.js"></script>
        <script src="plugin/js/sort.js"></script>
    </head>
    <body>
        <?php include("link.php"); ?>
        <div class="adminmain mag">
            <h2>登入登出紀錄</h2><br>
            <table class="admintable">
                <tr>
                    <td class="admintd">user</td>
                    <td class="admintd">move</td>
                    <td class="admintd">time</td>
                    <td class="admintd">ps</td>
                </tr>
                <?php
                $row=query($db,"SELECT*FROM `log`");
                for($i=0;$i<count($row);$i++){
                    ?>
                    <tr>
                        <td class="admintd"><?= $row[$i][1] ?></td>
                        <td class="admintd"><?= $row[$i][2] ?></td>
                        <td class="admintd"><?= $row[$i][3] ?></td>
                        <td class="admintd"><?= $row[$i][4] ?></td>
                    </tr>
                    <?php
                }
                ?>
            </table>
        </div>
    </body>
</html>
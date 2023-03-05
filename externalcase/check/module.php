<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>分數判別</title>
        <link rel="stylesheet" href="index.css">
    </head>
    <body>
        <?php
            include("link.php");
        ?>
        <form method="POST">
            <h2>請輸入項目數量</h2>
            <input type="number" name="num" id="num">
            <input type="submit" name="submit" value="確認"><br><br>
            <input type="button" onclick="location.href='index.php'" value="返回">
            <input type="button" onclick="location.href='module.php'" value="模板"><br>
            <input type="text" name="tablename" placeholder="模板名稱">
            <input type="submit" name="modulesubmit" value="送出">
            <div class="borad1">
                <table>
                    <tr>
                        <td class="border">項次</td>
                        <td class="border">主、客</td>
                        <td class="border">評分說明</td>
                        <td class="border" style="width: 100px;">配分</td>
                        <td class="border">備註及建議</td>
                        <td class="border">模組</td>
                    </tr>
                    <?php
                        for($i=0;$i<$_SESSION["num"];$i++){
                            ?>
                            <tr>
                                <td class="border"><input type="text" name="item<?= $i ?>" value="項次<?= $i+1 ?>" readonly></td>
                                <td class="border">
                                    <select name="objective<?= $i ?>">
                                        <option value="客">客</option>
                                        <option value="主">主</option>
                                        <option value="送">送</option>
                                    </select>
                                </td>
                                <td class="border"><textarea name="description<?= $i ?>" cols="30" rows="5"></textarea></td>
                                <td class="border"><input type="text" name="score<?= $i ?>" class="score" placeholder="輸入數字" value="2"></td>
                                <td class="border"><textarea name="remark<?= $i ?>" cols="30" rows="5"></textarea></td>
                                <td class="border"><input type="text" name="module<?= $i ?>" class="score" placeholder="輸入數字"></td>
                            </tr>
                            <?php
                        }
                    ?>
                </table>
            </div>
        </form>
        <?php
            if(isset($_POST["submit"])){
                $_SESSION["num"]=$_POST["num"];
                ?><script>alert("更改成功");location.href="module.php"</script><?php
            }
            if(isset($_POST["modulesubmit"])){
                $tablename=$_POST["tablename"];
                $row=fetchall(query($db,"SHOW TABLES"));
                $count=query($db,"SELECT*FROM `$tablename`");
                $use="no";
                for($i=0;$i<count($row);$i++){
                    if($row[$i][0]==$tablename){
                        $use="yes";
                    }
                }
                if($use=="no"){
                    $tablename=$_POST["tablename"];
                    inserttable($db,$tablename,"new");
                    for($i=0;$i<count($count);$i++){
                        $item=$_POST["item".$i];
                        $objective=$_POST["objective".$i];
                        $description=$_POST["description".$i];
                        $score=$_POST["score".$i];
                        $remark=$_POST["remark".$i];
                        $module=$_POST["module".$i];
                        query($db,"INSERT INTO `$tablename`(`item`,`objective`,`description`,`score`,`remark`,`module`)VALUES('$item','$objective','$description','$score','$remark','$module')");
                    }
                    ?><script>alert("新增成功");location.href="index.php"</script><?php
                }else{
                    ?><script>alert("工作表已存在");location.href="index.php"</script><?php
                }
            }
        ?>
    </body>
</html>
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
            <input type="button" onclick="location.href='index.php'" value="返回"><br><br>
            <input type="submit" name="submit" value="送出"><br><br><br>
            <input type="button" class="right" onclick="location.href='index.php?clearall='" value="重整">
            <?php
                checktable($db,fetchall(query($db,"SHOW TABLES")),true);
                if(isset($_SESSION["usingtable"])){
                    $usingtable=$_SESSION["usingtable"];
                    $row=fetchall(query($db,"SELECT*FROM `$usingtable`"));
                    ?>
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
                            for($i=0;$i<count($row);$i++){
                                ?>
                                <tr>
                                    <td class="border"><input type="text" name="item<?= $i ?>" value="<?= $row[$i][1] ?>" readonly></td>
                                    <td class="border">
                                        <?php
                                        if($row[$i][2]=="客"){

                                            ?>
                                            <select name="objective<?= $i ?>">
                                                <option value="客" selected>客</option>
                                                <option value="主">主</option>
                                                <option value="送">送</option>
                                            </select>
                                            <?php
                                        }elseif($row[$i][2]=="主"){

                                            ?>
                                            <select name="objective<?= $i ?>">
                                                <option value="客">客</option>
                                                <option value="主" selected>主</option>
                                                <option value="送">送</option>
                                            </select>
                                            <?php
                                        }else{

                                            ?>
                                            <select name="objective<?= $i ?>">
                                                <option value="客">客</option>
                                                <option value="主">主</option>
                                                <option value="送" selected>送</option>
                                            </select>
                                            <?php
                                        }
                                        ?>
                                    </td>
                                    <td class="border"><textarea name="description<?= $i ?>" cols="30" rows="5"><?= $row[$i][3] ?></textarea></td>
                                    <td class="border"><input type="text" name="score<?= $i ?>" class="score" placeholder="輸入數字" value="<?= $row[$i][4] ?>"></td>
                                    <td class="border"><textarea name="remark<?= $i ?>" cols="30" rows="5"><?= $row[$i][5] ?></textarea></td>
                                    <td class="border"><input type="text" name="module<?= $i ?>" class="score" placeholder="輸入數字" value="<?= $row[$i][6] ?>"></td>
                                </tr>
                                <?php
                            }
                            ?>
                        </table>
                    </div>
                    <?php
                }

                if(isset($_POST["submit"])){
                    $usingtable=$_SESSION["usingtable"];
                    $count=fetchall(query($db,"SELECT*FROM `$usingtable`"));
                    for($i=0;$i<count($count);$i=$i+1){
                        $item=$_POST["item".$i];
                        $objective=$_POST["objective".$i];
                        $description=$_POST["description".$i];
                        $score=$_POST["score".$i];
                        $remark=$_POST["remark".$i];
                        $module=$_POST["module".$i];
                        $id=$i+1;
                        query($db,"UPDATE `$usingtable` SET `item`='$item',`objective`='$objective',`description`='$description',`score`='$score',`remark`='$remark',`module`='$module' WHERE `id`='$id'");
                    }
                    session_unset();
                    ?><script>alert("更新成功");location.href="index.php"</script><?php
                }

                if(isset($_GET["table"])){
                    $_SESSION["usingtable"]=$_GET["table"];
                    ?><script>location.href="edit.php"</script><?php
                }
            ?>
        </form>
    </body>
</html>
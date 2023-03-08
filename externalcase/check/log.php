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
        <form>
            <input type="button" onclick="location.href='index.php'" value="返回"><br><br><br>
            <?php
                checktable($db,fetchall(query($db,"SHOW TABLES")),false);
                if(isset($_GET["table"])){
                    $_SESSION["name"]=$_GET["table"];
                    header("location:log.php");
                }
                
                if(isset($_SESSION["name"])){
                    $name=$_SESSION["name"];
                    $row=fetchall(query($db,"SELECT*FROM `$name`"));
                    $rowmain=fetch(query($db,"SELECT*FROM `main` WHERE `tablename`='$name'"));
                    if($rowmain[6]=="mark"){
                        ?>
                        <div class="borad1">
                            <table>
                                <tr>
                                    <td class="border">項次</td>
                                    <td class="border">主、客</td>
                                    <td class="border">評分說明</td>
                                    <td class="border" style="width: 100px;">配分</td>
                                    <td class="border" style="width: 100px;">得分</td>
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
                                                    <select name="objective<?= $i ?>" readonly>
                                                        <option value="客" selected>客</option>
                                                        <option value="主">主</option>
                                                        <option value="送">送</option>
                                                    </select>
                                                    <?php
                                                }elseif($row[$i][2]=="主"){

                                                    ?>
                                                    <select name="objective<?= $i ?>" readonly>
                                                        <option value="客">客</option>
                                                        <option value="主" selected>主</option>
                                                        <option value="送">送</option>
                                                    </select>
                                                    <?php
                                                }else{

                                                    ?>
                                                    <select name="objective<?= $i ?>" readonly>
                                                        <option value="客">客</option>
                                                        <option value="主">主</option>
                                                        <option value="送" selected>送</option>
                                                    </select>
                                                    <?php
                                                }
                                                ?>
                                            </td>
                                            <td class="border"><textarea name="description<?= $i ?>" cols="30" rows="5" readonly><?= $row[$i][3] ?></textarea></td>
                                            <td class="border"><input type="text" name="score<?= $i ?>" class="score" placeholder="輸入數字" value="<?= $row[$i][4] ?>" readonly></td>
                                            <td class="border"><input type="text" name="inputscore<?= $i ?>" class="score" placeholder="輸入數字" value="<?= $row[$i][5] ?>" readonly></td>
                                            <td class="border"><textarea name="remark<?= $i ?>" cols="30" rows="5" readonly><?= $row[$i][6] ?></textarea></td>
                                            <td class="border"><input type="text" name="module<?= $i ?>" class="score" placeholder="輸入數字" value="<?= $row[$i][7] ?>" readonly></td>
                                        </tr>
                                        <?php
                                    }
                                ?>
                                <tr>
                                    <td class="border" colspan="7">主觀建議</td>
                                </tr>
                                <tr>
                                    <td class="border" colspan="7"><textarea name="" cols="125" rows="7"><?= $rowmain[2] ?></textarea></td>
                                </tr>
                                <tr>
                                    <td class="border" colspan="7">其他建議</td>
                                </tr>
                                <tr>
                                    <td class="border" colspan="7"><textarea name="" cols="125" rows="7"><?= $rowmain[3] ?></textarea></td>
                                </tr>
                                <tr>
                                    <td class="border">id</td>
                                    <td class="border">使用模板</td>
                                    <td class="border">總分</td>
                                    <td class="border">得分</td>
                                    <td class="border">使用模式</td>
                                    <td class="border">評分日期</td>
                                    <td class="border"></td>
                                </tr>
                                <tr>
                                    <td class="border"><?= $rowmain[0] ?></td>
                                    <td class="border"><?= $rowmain[8] ?></td>
                                    <td class="border"><?= $rowmain[4] ?></td>
                                    <td class="border"><?= $rowmain[5] ?></td>
                                    <td class="border"><?= $rowmain[6] ?></td>
                                    <td class="border"><?= $rowmain[7] ?></td>
                                    <td class="border"></td>
                                </tr>
                            </table>
                        </div>
                        <?php
                    }else{
                        ?>
                        <div class="borad1">
                            <table>
                                <tr>
                                    <td class="border">項次</td>
                                    <td class="border">主、客</td>
                                    <td class="border">評分說明</td>
                                    <td class="border" style="width: 100px;">是否正確?</td>
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
                                                    <select name="objective<?= $i ?>" readonly>
                                                        <option value="客" selected>客</option>
                                                        <option value="主">主</option>
                                                        <option value="送">送</option>
                                                    </select>
                                                    <?php
                                                }elseif($row[$i][2]=="主"){

                                                    ?>
                                                    <select name="objective<?= $i ?>" readonly>
                                                        <option value="客">客</option>
                                                        <option value="主" selected>主</option>
                                                        <option value="送">送</option>
                                                    </select>
                                                    <?php
                                                }else{

                                                    ?>
                                                    <select name="objective<?= $i ?>" readonly>
                                                        <option value="客">客</option>
                                                        <option value="主">主</option>
                                                        <option value="送" selected>送</option>
                                                    </select>
                                                    <?php
                                                }
                                                ?>
                                            </td>
                                            <td class="border"><textarea name="description<?= $i ?>" cols="30" rows="5" readonly><?= $row[$i][3] ?></textarea></td>
                                            <td class="border">
                                                <?php
                                                if($row[4]=="是"){
                                                    ?>
                                                    <select name="correct<?= $i ?>">
                                                        <option value="是">是</option>
                                                        <option value="否">否</option>
                                                    </select>
                                                    <?php
                                                }else{
                                                    ?>
                                                    <select name="correct<?= $i ?>">
                                                        <option value="是" selected>是</option>
                                                        <option value="否">否</option>
                                                    </select>
                                                    <?php
                                                }
                                                ?>
                                            </td>
                                            <td class="border"><textarea name="remark<?= $i ?>" cols="30" rows="5" readonly><?= $row[$i][5] ?></textarea></td>
                                            <td class="border"><input type="text" name="module<?= $i ?>" class="score" placeholder="輸入數字" value="<?= $row[$i][6] ?>" readonly></td>
                                        </tr>
                                        <?php
                                    }
                                ?>
                                <tr>
                                    <td class="border" colspan="7">主觀建議</td>
                                </tr>
                                <tr>
                                    <td class="border" colspan="7"><textarea name="" cols="125" rows="7"><?= $rowmain[2] ?></textarea></td>
                                </tr>
                                <tr>
                                    <td class="border" colspan="7">其他建議</td>
                                </tr>
                                <tr>
                                    <td class="border" colspan="7"><textarea name="" cols="125" rows="7"><?= $rowmain[3] ?></textarea></td>
                                </tr>
                                <tr>
                                    <td class="border">id</td>
                                    <td class="border">使用模板</td>
                                    <td class="border">總分</td>
                                    <td class="border">得分</td>
                                    <td class="border">使用模式</td>
                                    <td class="border">評分日期</td>
                                </tr>
                                <tr>
                                    <td class="border"><?= $rowmain[0] ?></td>
                                    <td class="border"><?= $rowmain[8] ?></td>
                                    <td class="border"><?= $rowmain[4] ?></td>
                                    <td class="border"><?= $rowmain[5] ?></td>
                                    <td class="border"><?= $rowmain[6] ?></td>
                                    <td class="border"><?= $rowmain[7] ?></td>
                                </tr>
                            </table>
                        </div>
                        <?php
                    }
                }
            ?>
        </form>
    </body>
</html>
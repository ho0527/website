<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <title>分數判別</title>
        <link rel="stylesheet" href="index.css">
    </head>
    <body>
        <?php
            include("link.php");
            $_SESSION["getscore"]=0;
            $_SESSION["totalscore"]=0;
        ?>
        <form method="POST">
            <input type="button" onclick="location.href='log.php'" value="log">
            <input type="button" onclick="location.href='index.php?testtest='" value="評分版">
            <input type="button" onclick="location.href='index.php?test='" value="項次版">
            <input type="button" onclick="location.href='module.php'" value="模板">
            <input type="button" onclick="location.href='edit.php'" value="修改模板"><br><br>
            <input type="text" name="tablename" placeholder="名稱">
            <input type="submit" name="indexsubmit" value="送出"><br><br><br>
            <?php
                checktable($db,fetchall(query($db,"SHOW TABLES")),true);
                if(!isset($_SESSION["num"])){ $_SESSION["num"]=0; }
                if(!isset($_SESSION["usemod"])){ $_SESSION["usemod"]="item"; }
                if(isset($_SESSION["usingtable"])){
                    @$usingtable=$_SESSION["usingtable"];
                    @$totalscore=$_SESSION["totalscore"];
                    $row=fetchall(query($db,"SELECT*FROM `$usingtable`"));
                    if($_SESSION["usemod"]=="mark"){
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
                                    for($i=0;$i<count($row);$i=$i+1){
                                        $totalscore=$totalscore+$row[$i][4];
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
                                            <td class="border"><input type="text" name="inputscore<?= $i ?>" class="score" placeholder="輸入數字"></td>
                                            <td class="border"><textarea name="remark<?= $i ?>" cols="30" rows="5"><?= $row[$i][5] ?></textarea></td>
                                            <td class="border"><input type="text" name="module<?= $i ?>" class="score" placeholder="輸入數字" value="<?= $row[$i][6] ?>" readonly></td>
                                        </tr>
                                        <?php
                                    }
                                ?>
                                <tr>
                                    <td colspan="7" class="border">主觀建議</td>
                                </tr>
                                <tr>
                                    <td class="border" colspan="7"><textarea name="subjectivesuggestion" cols="125" rows="7"></textarea></td>
                                </tr>
                                <tr>
                                    <td colspan="7" class="border">其他建議</td>
                                </tr>
                                <tr>
                                    <td class="border" colspan="7"><textarea name="othersuggestion" cols="125" rows="7"></textarea></td>
                                </tr>
                            </table>
                        </div>
                        <?php
                    }else{
                        @$usingtable=$_SESSION["usingtable"];
                        @$totalscore=$_SESSION["totalscore"];
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
                                    for($i=0;$i<count($row);$i=$i+1){
                                        $totalscore=$totalscore+1;
                                        ?>
                                        <tr>
                                            <td class="border"><input type="text" name="item<?= $i ?>" value="<?= $row[$i][1] ?>" readonly></td>
                                            <td class="border">
                                                <select name="objective<?= $i ?>" readonly>
                                                <?php
                                                if($row[$i][2]=="客"){
                                                    ?>
                                                        <option value="客" selected>客</option>
                                                        <option value="主">主</option>
                                                        <option value="送">送</option>
                                                    <?php
                                                }elseif($row[$i][2]=="主"){
                                                    ?>
                                                    <option value="客">客</option>
                                                    <option value="主" selected>主</option>
                                                    <option value="送">送</option>
                                                    <?php
                                                }else{
                                                    ?>
                                                    <option value="客">客</option>
                                                    <option value="主">主</option>
                                                    <option value="送" selected>送</option>
                                                    <?php
                                                }
                                                ?>
                                                </select>
                                            </td>
                                            <td class="border"><textarea name="description<?= $i ?>" cols="30" rows="5" readonly><?= $row[$i][3] ?></textarea></td>
                                            <td class="border">
                                                <select name="correct<?= $i ?>">
                                                    <option value="是">是</option>
                                                    <option value="否" selected>否</option>
                                                </select>
                                            </td>
                                            <td class="border"><textarea name="remark<?= $i ?>" cols="30" rows="5"><?= $row[$i][5] ?></textarea></td>
                                            <td class="border"><input type="text" name="module<?= $i ?>" class="score" placeholder="輸入數字" value="<?= $row[$i][6] ?>" readonly></td>
                                        </tr>
                                        <?php
                                    }
                                ?>
                                <tr>
                                    <td colspan="6" class="border">主觀建議</td>
                                </tr>
                                <tr>
                                    <td class="border" colspan="6"><textarea name="subjectivesuggestion" cols="125" rows="7"></textarea></td>
                                </tr>
                                <tr>
                                    <td colspan="6" class="border">其他建議</td>
                                </tr>
                                <tr>
                                    <td class="border" colspan="6"><textarea name="othersuggestion" cols="125" rows="7"></textarea></td>
                                </tr>
                            </table>
                        </div>
                        <?php
                    }
                }
            ?>
        </form>
        <?php
            if(isset($_POST["indexsubmit"])){
                $getscore=$_SESSION["getscore"];
                $totalscore=$_SESSION["totalscore"];
                $usingtable=$_SESSION["usingtable"];
                $subjectivesuggestion=$_POST["subjectivesuggestion"];
                $othersuggestion=$_POST["othersuggestion"];
                $usemod=$_SESSION["usemod"];
                $tablename=$_POST["tablename"];
                $row=fetchall(query($db,"SHOW TABLES"));
                $use="no";
                for($i=0;$i<count($row);$i=$i+1){
                    if($row[$i][0]==$tablename){
                        $use="yes";
                    }
                }
                if($use=="no"){
                    if($_SESSION["usemod"]=="item"){
                        inserttable($db,$tablename,"correct");
                        $count=fetchall(query($db,"SELECT*FROM `$usingtable`"));
                        for($i=0;$i<count($count);$i=$i+1){
                            $item=$_POST["item".$i];
                            $objective=$_POST["objective".$i];
                            $description=$_POST["description".$i];
                            $correct=$_POST["correct".$i];
                            $remark=$_POST["remark".$i];
                            $module=$_POST["module".$i];
                            query($db,"INSERT INTO `$tablename`(`item`,`objective`,`description`,`correct`,`remark`,`module`)VALUES('$item','$objective','$description','$correct','$remark','$module')");
                        }
                        $row=fetchall(query($db,"SELECT*FROM `$tablename`"));
                        for($i=0;$i<count($row);$i=$i+1){
                            if($row[$i][4]=="是"||$row[$i][4]=="送"){
                                $getscore=$getscore+1;
                            }
                        }
                        $usemod="item";
                    }else{
                        inserttable($db,$tablename,"score");
                        $count=fetchall(query($db,"SELECT*FROM `$usingtable`"));
                        for($i=0;$i<count($count);$i=$i+1){
                            $item=$_POST["item".$i];
                            $objective=$_POST["objective".$i];
                            $description=$_POST["description".$i];
                            $score=$_POST["score".$i];
                            $inputscore=$_POST["inputscore".$i];
                            $remark=$_POST["remark".$i];
                            $module=$_POST["module".$i];
                            query($db,"INSERT INTO `$tablename`(`item`,`objective`,`description`,`score`,`inputscore`,`remark`,`module`)VALUES('$item','$objective','$description','$score','$inputscore','$remark','$module')");
                        }
                        $row=fetchall(query($db,"SELECT*FROM `$tablename`"));
                        for($i=0;$i<count($row);$i=$i+1){
                            $getscore=$getscore+$row[$i][5];
                        }
                        $usemod="mark";
                    }
                    query($db,"INSERT INTO `main`(`tablename`,`subjectivesuggestion`,`othersuggestion`,`totalscore`,`getscore`,`usemod`,`date`,`moudle`)VALUES('$tablename','$subjectivesuggestion','$othersuggestion','$totalscore','$getscore','$usemod','$time','$usingtable')");
                    session_unset();
                    ?><script>alert("上傳成功");location.href="index.php"</script><?php
                }else{
                    ?><script>alert("工作表已存在");location.href="index.php"</script><?php
                }
            }

            if(isset($_GET["test"])){
                $_SESSION["usemod"]="item";
                header("location:index.php");
            }

            if(isset($_GET["testtest"])){
                $_SESSION["usemod"]="mark";
                header("location:index.php");
            }
            
            if(isset($_POST["table"])){
                $_SESSION["usingtable"]=$_POST["table"];
                header("location:index.php");
            }
        ?>
    </body>
</html>
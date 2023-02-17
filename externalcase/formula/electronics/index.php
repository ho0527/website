<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Document</title>
        <link rel="stylesheet" href="../index.css">
    </head>
    <body>
        <?php include("../link.php"); ?>
        <img src="" alt="" class="mainimg">
        <div class="navigationbar">
            <div class="navigationbardiv">
                電子學
                <input type="button" class="adminbutton" onclick="location.href='../index.html'" value="首頁">
                <input type="button" class="adminbutton" onclick="location.href='howtouse.php'" value="使用手冊">
            </div>
        </div>
        <aside class="aside">
            <ul>
                基本公式<input type="button" onclick="location.href='index.php'" value="重製">
                <li><a href="#work">功</a></li>
                <li><a href="#Efficiency">效率</a></li>
            </ul>
        </aside>
        <div class="main">
            <div id="head">
                <ul>
                    基本公式<input type="button" onclick="location.href='index.php'" value="重製">
                    <li><a href="#work">功</a></li>
                    <li><a href="#Efficiency">效率</a></li>
                </ul>
            </div>
            <div class="formula" id="working">
                <div class="formulahead">
                    <img src="" alt="" class="formulaimg">
                    <div class="depiction">製作中</div>
                    <div class="note"></div>
                </div>
                <div class="formulainput">
                    <form>
                        input:<br>
                        <input type="text" name="" class="input" placeholder=""> = <input type="text" name="" class="input" placeholder=""> / <input type="text" name="" class="input" placeholder="">
                        <input type="submit" name="" value="送出" class="inputbutton">
                    </form>
                </div>
                <?php
                    if(isset($_GET[""])){
                        $is_numericflase=0;
                        if(!(is_numeric(get("")))){
                            $is_numericflase=$is_numericflase+1;
                        }
                        if(!(is_numeric(get("")))){
                            $is_numericflase=$is_numericflase+1;
                        }
                        if(!(is_numeric(get("in")))){
                            $is_numericflase=$is_numericflase+1;
                        }
                        if($is_numericflase==0){
                            if(intdata("")==(intdata("")/intdata(""))){
                                ?>
                                <div class="formulaoutput">
                                    output: 驗證正確
                                </div>
                                <?php
                            }else{
                                ?>
                                <div class="formulaoutput">
                                    output: 驗證失敗
                                </div>
                                <?php
                            }
                        }elseif($is_numericflase==1){
                            if(!(is_numeric(get("eit")))){
                                ?>
                                <div class="formulaoutput">
                                    output: 的值為<?= intdata("")/intdata("") ?>
                                </div>
                                <?php
                            }
                            if(!(is_numeric(get("")))){
                                ?>
                                <div class="formulaoutput">
                                    output: 的值為<?= intdata("")*intdata("") ?>
                                </div>
                                <?php
                            }
                            if(!(is_numeric(get("")))){
                                ?>
                                <div class="formulaoutput">
                                    output: 的值為<?= intdata("")/intdata("") ?>
                                </div>
                                <?php
                            }
                        }else{
                            ?>
                            <div class="formulaoutput">
                                output: [警告]不符合要求(要求:1)
                            </div>
                            <?php
                        }
                    }
                ?>
            </div>
            <div class="formula" id="working">
                <div class="formulahead">
                    <img src="" alt="" class="formulaimg">
                    <div class="depiction">製作中</div>
                    <div class="note"></div>
                </div>
                <div class="formulainput">
                    <form>
                        input:<br>
                        <input type="text" name="" class="input" placeholder=""> = <input type="text" name="" class="input" placeholder=""> / <input type="text" name="" class="input" placeholder="">
                        <input type="submit" name="" value="送出" class="inputbutton">
                    </form>
                </div>
                <?php
                    if(isset($_GET[""])){
                        $is_numericflase=0;
                        if(!(is_numeric(get("")))){
                            $is_numericflase=$is_numericflase+1;
                        }
                        if(!(is_numeric(get("")))){
                            $is_numericflase=$is_numericflase+1;
                        }
                        if(!(is_numeric(get("in")))){
                            $is_numericflase=$is_numericflase+1;
                        }
                        if($is_numericflase==0){
                            if(intdata("")==(intdata("")/intdata(""))){
                                ?>
                                <div class="formulaoutput">
                                    output: 驗證正確
                                </div>
                                <?php
                            }else{
                                ?>
                                <div class="formulaoutput">
                                    output: 驗證失敗
                                </div>
                                <?php
                            }
                        }elseif($is_numericflase==1){
                            if(!(is_numeric(get("eit")))){
                                ?>
                                <div class="formulaoutput">
                                    output: 的值為<?= intdata("")/intdata("") ?>
                                </div>
                                <?php
                            }
                            if(!(is_numeric(get("")))){
                                ?>
                                <div class="formulaoutput">
                                    output: 的值為<?= intdata("")*intdata("") ?>
                                </div>
                                <?php
                            }
                            if(!(is_numeric(get("")))){
                                ?>
                                <div class="formulaoutput">
                                    output: 的值為<?= intdata("")/intdata("") ?>
                                </div>
                                <?php
                            }
                        }else{
                            ?>
                            <div class="formulaoutput">
                                output: [警告]不符合要求(要求:1)
                            </div>
                            <?php
                        }
                    }
                ?>
            </div>
            <div class="formula" id="working">
                <div class="formulahead">
                    <img src="" alt="" class="formulaimg">
                    <div class="depiction">製作中</div>
                    <div class="note"></div>
                </div>
                <div class="formulainput">
                    <form>
                        input:<br>
                        <input type="text" name="" class="input" placeholder=""> = <input type="text" name="" class="input" placeholder=""> / <input type="text" name="" class="input" placeholder="">
                        <input type="submit" name="" value="送出" class="inputbutton">
                    </form>
                </div>
                <?php
                    if(isset($_GET[""])){
                        $is_numericflase=0;
                        if(!(is_numeric(get("")))){
                            $is_numericflase=$is_numericflase+1;
                        }
                        if(!(is_numeric(get("")))){
                            $is_numericflase=$is_numericflase+1;
                        }
                        if(!(is_numeric(get("in")))){
                            $is_numericflase=$is_numericflase+1;
                        }
                        if($is_numericflase==0){
                            if(intdata("")==(intdata("")/intdata(""))){
                                ?>
                                <div class="formulaoutput">
                                    output: 驗證正確
                                </div>
                                <?php
                            }else{
                                ?>
                                <div class="formulaoutput">
                                    output: 驗證失敗
                                </div>
                                <?php
                            }
                        }elseif($is_numericflase==1){
                            if(!(is_numeric(get("eit")))){
                                ?>
                                <div class="formulaoutput">
                                    output: 的值為<?= intdata("")/intdata("") ?>
                                </div>
                                <?php
                            }
                            if(!(is_numeric(get("")))){
                                ?>
                                <div class="formulaoutput">
                                    output: 的值為<?= intdata("")*intdata("") ?>
                                </div>
                                <?php
                            }
                            if(!(is_numeric(get("")))){
                                ?>
                                <div class="formulaoutput">
                                    output: 的值為<?= intdata("")/intdata("") ?>
                                </div>
                                <?php
                            }
                        }else{
                            ?>
                            <div class="formulaoutput">
                                output: [警告]不符合要求(要求:1)
                            </div>
                            <?php
                        }
                    }
                ?>
            </div>
            <div class="formula" id="working">
                <div class="formulahead">
                    <img src="" alt="" class="formulaimg">
                    <div class="depiction">製作中</div>
                    <div class="note"></div>
                </div>
                <div class="formulainput">
                    <form>
                        input:<br>
                        <input type="text" name="" class="input" placeholder=""> = <input type="text" name="" class="input" placeholder=""> / <input type="text" name="" class="input" placeholder="">
                        <input type="submit" name="" value="送出" class="inputbutton">
                    </form>
                </div>
                <?php
                    if(isset($_GET[""])){
                        $is_numericflase=0;
                        if(!(is_numeric(get("")))){
                            $is_numericflase=$is_numericflase+1;
                        }
                        if(!(is_numeric(get("")))){
                            $is_numericflase=$is_numericflase+1;
                        }
                        if(!(is_numeric(get("in")))){
                            $is_numericflase=$is_numericflase+1;
                        }
                        if($is_numericflase==0){
                            if(intdata("")==(intdata("")/intdata(""))){
                                ?>
                                <div class="formulaoutput">
                                    output: 驗證正確
                                </div>
                                <?php
                            }else{
                                ?>
                                <div class="formulaoutput">
                                    output: 驗證失敗
                                </div>
                                <?php
                            }
                        }elseif($is_numericflase==1){
                            if(!(is_numeric(get("eit")))){
                                ?>
                                <div class="formulaoutput">
                                    output: 的值為<?= intdata("")/intdata("") ?>
                                </div>
                                <?php
                            }
                            if(!(is_numeric(get("")))){
                                ?>
                                <div class="formulaoutput">
                                    output: 的值為<?= intdata("")*intdata("") ?>
                                </div>
                                <?php
                            }
                            if(!(is_numeric(get("")))){
                                ?>
                                <div class="formulaoutput">
                                    output: 的值為<?= intdata("")/intdata("") ?>
                                </div>
                                <?php
                            }
                        }else{
                            ?>
                            <div class="formulaoutput">
                                output: [警告]不符合要求(要求:1)
                            </div>
                            <?php
                        }
                    }
                ?>
            </div>
        </div>
    </body>
</html>
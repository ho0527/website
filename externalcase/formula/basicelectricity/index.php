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
                基本電學
                <input type="button" class="adminbutton" onclick="location.href='../index.html'" value="首頁">
                <input type="button" class="adminbutton" onclick="location.href='howtouse.php'" value="使用手冊">
            </div>
        </div>
        <aside class="aside">
            <ul>
                基本公式<input type="button" onclick="location.href='index.php'" value="重製">
                <li><a href="#work">功</a></li>
                <li><a href="#efficiency">效率</a></li>
            </ul>
        </aside>
        <div class="main">
            <div id="head">
                <ul>
                    基本公式<input type="button" onclick="location.href='index.php'" value="重製">
                    <li><a href="#work">功</a></li>
                    <li><a href="#efficiency">效率</a></li>
                </ul>
            </div>
            <div class="formula" id="work">
                <div class="formulahead">
                    <img src="" alt="" class="formulaimg">
                    <div class="depiction">W = F S [J]</div>
                    <div class="note">W=work F=force S=displacement [J]=焦耳</div>
                </div>
                <div class="formulainput">
                    <form>
                        input:<br>
                        <input type="text" name="work" class="input" placeholder="W"> = <input type="text" name="force" class="input" placeholder="F"> X <input type="text" name="displacement" class="input" placeholder="S">
                        <input type="hidden" name="wfs">
                        <input type="button" onclick="worksubmit(this)" value="送出" class="inputbutton">
                    </form>
                </div>
                <?php
                    if(isset($_GET["wfs"])){
                        $is_numericflase=0;
                        if(!(is_numeric(get("work")))){
                            $is_numericflase=$is_numericflase+1;
                        }
                        if(!(is_numeric(get("force")))){
                            $is_numericflase=$is_numericflase+1;
                        }
                        if(!(is_numeric(get("displacement")))){
                            $is_numericflase=$is_numericflase+1;
                        }
                        if($is_numericflase==0){
                            if(intdata("work")==(intdata("force")*intdata("displacement"))){
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
                            if(!(is_numeric(get("work")))){
                                ?>
                                <div class="formulaoutput">
                                    output: W的值為<?= intdata("force")*intdata("displacement") ?>J
                                </div>
                                <?php
                            }
                            if(!(is_numeric(get("force")))){
                                ?>
                                <div class="formulaoutput">
                                    output: F的值為<?= intdata("work")/intdata("displacement") ?>
                                </div>
                                <?php
                            }
                            if(!(is_numeric(get("displacement")))){
                                ?>
                                <div class="formulaoutput">
                                    output: S的值為<?= intdata("work")/intdata("force") ?>
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
            <div class="formula" id="efficiency">
                <div class="formulahead">
                    <img src="" alt="" class="formulaimg">
                    <div class="depiction">η = <sup>W<sub class="denote">out</sub></sup>&frasl;<sub>W<sub class="denote">in</sub></sub></div>
                    <div class="note">W<sub>out</sub>=output work W<sub>in</sub>=input work η=efficiency</div>
                </div>
                <div class="formulainput">
                    <form>
                        input:<br>
                        <input type="text" name="eit" class="input" placeholder="η"> = <input type="text" name="wout" class="input" placeholder="wout"> / <input type="text" name="win" class="input" placeholder="win">
                        <input type="hidden" name="eitwoutin">
                        <input type="button" class="inputbutton" onclick="efficiency(this)" value="送出">
                    </form>
                </div>
                <?php
                    if(isset($_GET["eitwoutin"])){
                        $is_numericflase=0;
                        if(!(is_numeric(get("eit")))){
                            $is_numericflase=$is_numericflase+1;
                        }
                        if(!(is_numeric(get("wout")))){
                            $is_numericflase=$is_numericflase+1;
                        }
                        if(!(is_numeric(get("win")))){
                            $is_numericflase=$is_numericflase+1;
                        }
                        if($is_numericflase==0){
                            if(intdata("eit")==(intdata("wout")/intdata("win"))){
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
                                    output: η的值為<?= intdata("wout")/intdata("win") ?>(<?= (intdata("wout")/intdata("win"))*100 ?>%)
                                </div>
                                <?php
                            }
                            if(!(is_numeric(get("wout")))){
                                ?>
                                <div class="formulaoutput">
                                    output: W<sub>out</sub>的值為<?= intdata("eit")*intdata("win") ?>
                                </div>
                                <?php
                            }
                            if(!(is_numeric(get("win")))){
                                ?>
                                <div class="formulaoutput">
                                    output: W<sub>in</sub>的值為<?= intdata("wout")/intdata("eit") ?>
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
                        <input type="hidden" name="">
                        <input type="button" onclick="" value="送出" class="inputbutton">
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
                        <input type="hidden" name="">
                        <input type="button" onclick="" value="送出" class="inputbutton">
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
                        <input type="hidden" name="">
                        <input type="button" onclick="" value="送出" class="inputbutton">
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
                        <input type="hidden" name="">
                        <input type="button" onclick="" value="送出" class="inputbutton">
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
                        <input type="hidden" name="">
                        <input type="button" onclick="" value="送出" class="inputbutton">
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
        <script src="index.js"></script>
    </body>
</html>
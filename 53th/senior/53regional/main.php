<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>咖啡商品展示系統</title>
        <link rel="stylesheet" href="index.css">
        <link rel="stylesheet" href="plugin/css/macossection.css">
        <script src="plugin/js/macossection.js"></script>
    </head>
    <body>
        <?php
            include("link.php");
            if(!isset($_SESSION["data"])){ header("location:index.php"); }
            if(!isset($_SESSION["pagecount"])){ $_SESSION["pagecount"]=1; }
            if($_SESSION["permission"]=="管理者"){
                ?>
                <div class="navigationbar">
                    <div class="navigationbarleft">
                        <div class="navigationbartitle">咖啡商品展示系統-首頁</div>
                    </div>
                    <div class="navigationbarright">
                        <input type="button" class="navigationbarbutton navigationbarselect" onclick="location.href='main.php'" value="首頁">
                        <input type="button" class="navigationbarbutton" onclick="location.href='productindex.php'" value="上架商品">
                        <input type="button" class="navigationbarbutton" onclick="location.href='search.php'" value="查詢">
                        <input type="button" class="navigationbarbutton" onclick="location.href='admin.php'" value="會員管理">
                        <input type="button" class="navigationbarbutton" onclick="location.href='api.php?logout='"value="登出">
                    </div>
                </div>
                <?php
            }else{
                ?>
                <div class="navigationbar">
                    <div class="navigationbarleft">
                        <div class="navigationbartitle">咖啡商品展示系統-首頁</div>
                    </div>
                    <div class="navigationbarright">
                        <input type="button" class="navigationbarbutton navigationbarselect" onclick="location.href='main.php'" value="首頁">
                        <input type="button" class="navigationbarbutton" value="標題">
                        <input type="button" class="navigationbarbutton" onclick="location.href='search.php'" value="查詢">
                        <input type="button" class="navigationbarbutton" onclick="location.href='api.php?logout='"value="登出">
                    </div>
                </div>
                <?php
            }
        ?>
        <div class="productmain macossectiondiv">
            <?php
                $row=query($db,"SELECT*FROM `coffee`");
                usort($row,function($a,$b){ return $b[0]-$a[0]; });
                $count=0;
                if(count($row)<=4){ $rowcount=count($row); }
                $pagecount=count($row)/4;
                $modpagecount=count($row)%4;
                $maxpagecount=ceil(count($row)/4);
                if(isset($_GET["key"])){
                    $key=$_GET["key"];
                    if($key=="first"){
                        $start=0;
                        $rowcount=4;
                        if(count($row)<=4){ $rowcount=count($row); }
                        $_SESSION["pagecount"]=1;
                    }elseif($key=="prev"){
                        if($_SESSION["pagecount"]>1){
                            $start=($_SESSION["pagecount"]-1)*4-4;
                            $rowcount=($_SESSION["pagecount"]-1)*4;
                            if($_SESSION["pagecount"]-1==$maxpagecount){ $rowcount=count($row); }
                            $_SESSION["pagecount"]=$_SESSION["pagecount"]-1;
                        }else{
                            $start=0;
                            $rowcount=4;
                            if(count($row)<=4){ $rowcount=count($row); }
                            $_SESSION["pagecount"]=1;
                        }
                    }elseif($key=="next"){
                        if($_SESSION["pagecount"]<$maxpagecount){
                            $start=$_SESSION["pagecount"]*4;
                            $rowcount=($_SESSION["pagecount"]+1)*4;
                            if($_SESSION["pagecount"]+1==$maxpagecount){ $rowcount=(floor($pagecount)*4)+$modpagecount; }
                            $_SESSION["pagecount"]=$_SESSION["pagecount"]+1;
                        }else{
                            $start=floor($pagecount)*4;
                            $rowcount=(floor($pagecount)*4)+$modpagecount;
                            $_SESSION["pagecount"]=$maxpagecount;
                        }
                    }elseif($key=="end"){
                        $start=floor($pagecount)*4;
                        $rowcount=(floor($pagecount)*4)+$modpagecount;
                        $_SESSION["pagecount"]=$maxpagecount;
                    }else{ ?><script>alert("[ERROR] key type error");location.href="main.php"</script><?php }
                }else{
                    $start=0;
                    $rowcount=4;
                }
                ?>
                商品展示區 頁數: <?= $_SESSION["pagecount"]; ?><br>
                <input type="button" onclick="location.href='?key=first'" value="到最前一頁">
                <input type="button" onclick="location.href='?key=prev'" value="上一頁">
                <input type="button" onclick="location.href='?key=next'" value="下一頁">
                <input type="button" onclick="location.href='?key=end'" value="到最後一頁">
                <?php
                for($i=$start;$i<$rowcount;$i=$i+1){
                    $data="productleft";
                    if($count%2==0){ ?><div class="productdiv"><?php }
                    if($count%2==1){ $data="productright"; }
                    $productrow=query($db,"SELECT*FROM `product` WHERE `id`=?",[$row[$i][7]])[0];
                    ?>
                    <div class="<?php echo($data); ?> product macossectiondiv">
                        <?php if($_SESSION["permission"]=="管理者"){ ?><div class="id"><input type="button" onclick="location.href='productedit.php?id=<?php echo($row[$i][0]); ?>'" value="修改"></div><?php } ?>
                        <div class="name macossectiondiv" style="<?php echo($productrow[1]) ?>">商品名稱: <?php echo($row[$i][2]); ?></div>
                        <div class="cost macossectiondiv" style="<?php echo($productrow[2]) ?>">費用: <?php echo($row[$i][4]); ?></div>
                        <div class="date macossectiondiv" style="<?php echo($productrow[3]) ?>">發布日期: <?php echo($row[$i][5]); ?></div>
                        <div class="link macossectiondiv" style="<?php echo($productrow[4]) ?>">相關連結: <?php echo($row[$i][6]); ?></div>
                        <div class="introduction macossectiondiv" style="<?php echo($productrow[5]) ?>">
                            商品簡介<br>
                            <?php echo($row[$i][3]); ?>
                        </div>
                        <div class="picture macossectiondiv" style="<?php echo($productrow[6]) ?>"><img src="<?php echo($row[$i][1]); ?>" class="img" width="175px"></div>
                    </div>
                    <?php
                    if($count%2==1||count($row)-1==$i){ ?></div><?php }
                    $count=$count+1;
                }
            ?>
        </div>
    </body>
</html>
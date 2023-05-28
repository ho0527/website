<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>新增貼文</title>
        <link href="index.css" rel="Stylesheet">
    </head>
    <body>
        <?php
            include("link.php");
            if(!isset($_SESSION["data"])){ header("location:index.php"); }
        ?>
        <div class="main">
            <form method="POST" enctype="multipart/form-data">
                <h2>新增貼文</h2>
                <hr>
                <div class="inputdiv">
                    <div class="inputhint">*context</div><textarea class="context" name="context"></textarea>
                </div>
                <div class="inputdiv">
                    <div class="inputhint">*type</div>
                    <select class="select" name="type">
                        <option value="none">none</option>
                        <option value="public">public</option>
                        <option value="follow">only follow</option>
                        <option value="self">only self</option>
                    </select>
                </div>
                <div class="inputdiv">
                    <div class="inputhint">tag</div><input type="text" class="input" name="tag" placeholder="空白分隔每個tag">
                </div>
                <div class="inputdiv">
                    <div class="inputhint">location name</div><input type="text" class="input" name="location">
                </div>
                *<input type="button" class="button" name="password" onclick="document.getElementById('file').click()" value="上傳頭像"><br><br>
                <input type="button" class="longbutton" onclick="location.href='main.php'" value="返回主頁">
                <input type="submit" class="longbutton" name="submit" value="送出">
                <input type="file" class="file" id="file" name="postimage[]" accept=".png,.jpg" multiple="multiple">
            </form>
        </div>
        <?php
            if(isset($_POST["submit"])){
                $context=$_POST["context"];
                $type=$_POST["type"];
                $tag=$_POST["tag"];
                $location=$_POST["location"];
                if($context==""){
                    ?><script>alert("請填寫內容!");location.href="newpost.php"</script><?php
                }elseif($type=="none"){
                    ?><script>alert("請選擇類型");location.href="newpost.php"</script><?php
                }elseif($_FILES["postimage"]["name"][0]==""){
                    ?><script>alert("請上傳圖片");location.href="newpost.php"</script><?php
                }else{
                    $data=$_SESSION["data"];
                    query($db,"INSERT INTO `post`(`userid`,`linkcount`,`context`,`permission`,`location`,`time`)VALUES('$data','0',?,?,?,'$time')",[$context,$type,$location]);
                    $row=query($db,"SELECT*FROM `post`");
                    rsort($row);
                    $postid=$row[0][0];
                    $file="";
                    $tag=explode(" ",$tag);
                    for($i=0;$i<count($tag);$i=$i+1){
                        query($db,"INSERT INTO `tag`(`postid`,`tag`,`time`)VALUES('$postid',?,'$time')",[$tag[$i]]);
                    }
                    for($i=0;$i<count($_FILES["postimage"]["name"]);$i=$i+1){
                        $file="image/postimage/".$_FILES["postimage"]["name"][$i];
                        $j=1;
                        while(file_exists($file)){
                            $file="image/postimage/".$j."_".$_FILES["postimage"]["name"][$i];
                            $j=$j+1;
                        }
                        move_uploaded_file($_FILES["postimage"]["tmp_name"][$i],$file);
                        query($db,"INSERT INTO `postimage`(`postid`,`imageurl`,`time`)VALUES('$postid',?,'$time')",[$file]);
                    }
                    query($db,"INSERT INTO `log`(`number`,`move`,`time`)VALUES('$data','登入成功','$time')");
                    ?><script>alert("新增成功!");location.href="main.php"</script><?php
                }
            }
        ?>
    </body>
</html>
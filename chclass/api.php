<?php
    include("link.php");
    if(isset($_GET["logout"])){
        if(isset($_SESSION["data"])){
            query($db,"INSERT INTO `log`(`userid`, `move`, `movetime`, `ps`)VALUES(?,?,?,?)",[$_SESSION["data"],"登出成功",$time,""]);
            ?><script>alert("登出成功!");location.href="index.html"</script><?php
            session_unset();
        }else{
            ?><script>alert("請先登入!");location.href="index.html"</script><?php
        }
    }

    if(isset($_GET["logincheck"])){
        if(isset($_SESSION["data"])){
            if($_SESSION["data"]==1||$_SESSION["data"]==2||$_SESSION["data"]==3){
                echo(json_encode(["success"=>"true","permission"=>"admin"]));
            }else{
                echo(json_encode(["success"=>"true","permission"=>"user"]));
            }
        }else{
            echo(json_encode(["success"=>"false"]));
        }
    }

    if(isset($_GET["scorelist"])){
        if($_SESSION["data"]==1||$_SESSION["data"]==2||$_SESSION["data"]==3){
            $row=query($db,"SELECT*FROM `score`");
        }else{
            $row=query($db,"SELECT*FROM `score` WHERE `ps`=''");
        }
        $data=[];
        $titlelist=[];
        for($i=0;$i<count($row);$i=$i+1){
            $userid=$row[$i][1];
            $title=$row[$i][2];
            $score=$row[$i][3];

            $data[$title][$userid][]=[$score];

            if(!in_array($title,$titlelist)){
                $titlelist[]=$title;
            }
        }
        echo(json_encode([$data,$titlelist]));
    }

    if(isset($_GET["editscorelist"])){
        $id=$_GET["editscorelist"];
        $row=query($db,"SELECT*FROM `score` WHERE `classmateid`=?",[$id]);
        echo(json_encode($row));
    }
?>
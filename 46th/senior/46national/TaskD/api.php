<?php
    include("link.php");
    if(isset($_GET["logout"])){
        if(isset($_SESSION["data"])){
            ?><script>alert("登出成功!");location.href="index.html"</script><?php
            session_unset();
        }else{
            ?><script>alert("請先登入!");location.href="index.html"</script><?php
        }
    }

    if(isset($_GET["logincheck"])){
        if(isset($_SESSION["data"])){
            echo("true");
        }else{
            echo("false");
        }
    }

    if(isset($_GET["traintypelist"])){
        $row=query($db,"SELECT*FROM `type`");
        echo(json_encode($row));
    }

    if(isset($_GET["traincodelist"])){
        $row=query($db,"SELECT*FROM `train`");
        $data=[];
        for($i=0;$i<count($row);$i=$i+1){
            $data[]=$row[$i][2];
        }
        echo(json_encode($data));
    }

    if(isset($_GET["stationlist"])){
        $row=query($db,"SELECT*FROM `station`");
        echo(json_encode($row));
    }

    if(isset($_GET["trainlist"])){
        $row=query($db,"SELECT*FROM `train`");
        $stoprow=query($db,"SELECT*FROM `stop`");
        $stationrow=query($db,"SELECT*FROM `station`");
        echo(json_encode([$row,$stoprow,$stationrow]));
    }

    if(isset($_GET["ticket"])){
        $row=query($db,"SELECT*FROM `ticket`");
        echo(json_encode($row));
    }

    if(isset($_GET["seatlist"])){
        $row=query($db,"SELECT*FROM `ticket`");
        $data=[];
        for($i=0;$i<count($row);$i=$i+1){
            $data[]="";
        }
        echo(json_encode($data));
    }

    if(isset($_GET["key"])){
        if($_GET["key"]=="deltraintype"){
            $id=$_GET["id"];
            if(!query($db,"SELECT*FROM `train` WHERE `traintypeid`=?",[$id])){
                $row=query($db,"DELETE FROM `type` WHERE `id`=?",[$id]);
                ?><script>alert("刪除成功!");location.href="admintype.html"</script><?php
            }else{
                ?><script>alert("列車被使用!");location.href="admintype.html"</script><?php
            }
        }
        if($_GET["key"]=="delstation"){
            $id=$_GET["id"];
            $row=query($db,"DELETE FROM `station` WHERE `id`=?",[$id]);
            ?><script>alert("刪除成功!");location.href="adminstation.html"</script><?php
        }
        /*
        status:
        prepare: 未發車
        start: 已發車
        end: 已結束
        delete: 被刪除
        */
        if($_GET["key"]=="deltrain"){
            $id=$_GET["id"];
            if(query($db,"SELECT*FROM `ticket` WHERE `trainid`=?AND`status`='prepare'",[$id])){
                ?><script>if(confirm("列車有被訂票是否繼續刪除?")){ location.href="api.php?deltrain=&id=<?php echo($id) ?>" }else{ location.href="admintrain.html" }</script><?php
            }else{
                ?><script>location.href="api.php?deltrain=&id=<?php echo($id) ?>"</script><?php
            }
        }
    }

    if(isset($_GET["deltrain"])){
        $id=$_GET["id"];
        query($db,"DELETE FROM `train` WHERE `id`=?",[$id]);
        query($db,"DELETE FROM `stop` WHERE `trainid`=?",[$id]);
        ?><script>alert("刪除成功!");location.href="admintrain.html"</script><?php
    }
?>
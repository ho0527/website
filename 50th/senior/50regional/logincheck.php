<?php
    include("link.php");
    $projectdata=[];
    $data=$_SESSION["data"];
    $location="main";
    $count=0;

    // $rowuser=query($db,"SELECT*FROM `user`");
    $rowproject=query($db,"SELECT*FROM `project`");
    $rowfacing=query($db,"SELECT*FROM `facing`");
    $rowopinion=query($db,"SELECT*FROM `opinion`");
    $rowscore=query($db,"SELECT*FROM `score`");
    $rowscoreindex=query($db,"SELECT*FROM `scoreindex`");
    $rowplan=query($db,"SELECT*FROM `plan`");
    $rowplanfacingopinion=query($db,"SELECT*FROM `planfacingopinion`");
    $rowplanscore=query($db,"SELECT*FROM `planscore`");
    // echo "\$rowuser ="; print_r($rowuser); echo "<br>";
    echo "\$rowproject ="; print_r($rowproject); echo "<br>";
    echo "\$rowfacing ="; print_r($rowfacing); echo "<br>";
    echo "\$rowopinion ="; print_r($rowopinion); echo "<br>";
    echo "\$rowscore ="; print_r($rowscore); echo "<br>";
    echo "\$rowscoreindex ="; print_r($rowscoreindex); echo "<br>";
    echo "\$rowplan ="; print_r($rowplan); echo "<br>";
    echo "\$rowplanfacingopinion ="; print_r($rowplanfacingopinion); echo "<br>";
    echo "\$rowplanscore ="; print_r($rowplanscore); echo "<br>";

    if($data==1){ $location="admin"; }
    for($i=0;$i<count($rowproject);$i=$i+1){
        $leader=$rowproject[$i][3];
        $member=explode("|&|",$rowproject[$i][4]);
        $status="";
        if($data==$leader||$data=="1"){
            $status="leader";
        }elseif(in_array($data,$member)){
            $status="member";
        }else{
            $status="false";
        }
        if($status!="false"){
            $projectdata[]=["projectid"=>$rowproject[$i][0]];
            for($j=0;$j<count($rowfacing);$j=$j+1){

            }
            for($j=0;$j<count($rowopinion);$j=$j+1){

            }
            for($j=0;$j<count($rowscore);$j=$j+1){

            }
            for($j=0;$j<count($rowscoreindex);$j=$j+1){

            }
            for($j=0;$j<count($rowplan);$j=$j+1){

            }
            for($j=0;$j<count($rowplanfacingopinion);$j=$j+1){

            }
            for($j=0;$j<count($rowplanscore);$j=$j+1){

            }

            echo "\$projectdata ="; print_r($projectdata); echo "<br>";
            $count=$count+1;
        }
    }
    $_SESSION["projectdata"]=$projectdata;
    ?><script>//alert("登入成功");location.href="<?php //echo($location); ?>.php"</script><?php
?>
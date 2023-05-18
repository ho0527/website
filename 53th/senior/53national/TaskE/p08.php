<?php
    $memorybefore=memory_get_usage();

    echo("p01\n");
    $n=trim(fgets(STDIN));
    $ans=[];
    for($i=0;$i<$n;$i=$i+1){
        $array=explode(" ",trim(fgets(STDIN)));//將字元拆開
        rsort($array);
        $ans[]=($array[0]+$array[count($array)-1]);//相加
    }

    for($i=0;$i<count($ans);$i=$i+1){
        echo($ans[$i]."\n");
    }

    $memoryafter=memory_get_usage();
    $memorydifference=$memoryafter-$memorybefore;
    echo("memory used ".($memorydifference/1048576)."MB");
?>
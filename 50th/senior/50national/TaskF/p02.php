<?php
    $memoryBefore=memory_get_usage();
    echo("p02\n");
    $m=trim(fgets(STDIN));
    $data=[];
    $maindata=[];
    $ans=[];
    for($i=0;$i<$m;$i=$i+1){
        $data[]=trim(fgets(STDIN));
    }
    $n=trim(fgets(STDIN));
    for($i=0;$i<$n;$i=$i+1){
        $maindata=explode(trim(fgets(STDIN))," ");
    }
    for($i=0;$i<count($ans);$i=$i+1){
        echo($ans[$i]."\n");
    }
    echo("\n");
    $memoryAfter=memory_get_usage();
    $memoryDifference=$memoryAfter-$memoryBefore;
    echo("memory used ".($memoryDifference/1048576)."MB");
?>
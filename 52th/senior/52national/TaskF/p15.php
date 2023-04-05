<?php
    $memoryBefore=memory_get_usage();
    echo("p15\n");

    $data=preg_split("/\W+/",strtolower(trim(fgets(STDIN))),-1,PREG_SPLIT_NO_EMPTY);
    $count=array_count_values($data);

    // 將單字按照出現次數和字母順序進行排序
    uksort($count,function($a,$b)use($count){
        if($count[$a]==$count[$b]){
            return strcasecmp($a,$b);
        }else{
            return $count[$b]-$count[$a];
        }
    });

    // 取出前三個單字
    $ans=array_slice(array_keys($count),0,3);

    // 將結果輸出到 STDOUT
    for($i=0;$i<count($ans);$i=$i+1){
        echo($ans[$i]."\n");
    }
    echo("\n");

    $memoryAfter=memory_get_usage();
    $memoryDifference=$memoryAfter-$memoryBefore;
    echo("memory used: ".($memoryDifference/1048576)."MB");
?>
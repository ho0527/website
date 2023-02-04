<?php
    $memoryBefore=memory_get_usage();
    echo("p01\n");
    $n=trim(fgets(STDIN));
    for($i=0;$i<$n;$i=$i+1){
        $arr=explode(" ",trim(fgets(STDIN)));//將字元拆開
        $max=max($arr);//最大值
        $min=min($arr);//最小值
        echo($max+$min.PHP_EOL);//相加
    }
    echo("\n");
    $memoryAfter=memory_get_usage();
    $memoryDifference=$memoryAfter-$memoryBefore;
    echo("Memory used: ".($memoryDifference/1048576)."MB");
?>
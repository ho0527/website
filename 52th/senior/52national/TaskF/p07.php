<?php
    $memoryBefore=memory_get_usage();
    echo("p07\n");
    $n=trim(fgets(STDIN));
    $arr=[];
    $max=0;
    if((1<=$n)&&($n<=(2**31-1))){
        for($i=0;$i<$n;$i=$i+1){
            $num=trim(fgets(STDIN));
            if(isset($arr[$num])){
                $arr[$num]++;
            }else{
                $arr[$num]=1;
            }
        }
        // 找出出現次數最多的數字
        foreach($arr as $value){
            if($value>$max){
                $max=$value;
            }
        }
        // 若所有數字出現次數都相同，則不存在眾數，輸出-1
        if($max==1){
            echo("-1".PHP_EOL);
            return;
        }
        // 輸出眾數，由數值小到大每行輸出一個
        ksort($arr);
        echo("output: \n");
        foreach($arr as $key=>$value){
            if($value==$max){
                echo($key.PHP_EOL);
            }
        }
    }else{
        echo("輸入未符合要求");
    }
    echo("\n");
    $memoryAfter=memory_get_usage();
    $memoryDifference=$memoryAfter-$memoryBefore;
    echo("memory used: ".($memoryDifference/1048576)."MB");
?>
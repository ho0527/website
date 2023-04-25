<?php
    $memoryBefore=memory_get_usage();
    echo("p07\n");
    $n=trim(fgets(STDIN));
    $array=[];
    $max=0;
    if((1<=$n)&&($n<=(2**31-1))){
        for($i=0;$i<$n;$i=$i+1){
            $num=trim(fgets(STDIN));
            if(isset($array[$num])){
                $array[$num]=$array[$num]+1;
            }else{
                $array[$num]=1;
            }
        }

        // 找出出現次數最多的數字
        for($i=0;$i<count($array);$i=$i+1){
            $value=$array[array_keys($array)[$i]];
            if($value>$max){
                $max=$value;
            }
        }

        echo("\n");
        // 若所有數字出現次數都相同，則不存在眾數，輸出-1
        if($max==1){
            echo("-1".PHP_EOL);
        }else{
            // 輸出眾數，由數值小到大每行輸出一個
            ksort($array);
            $key=array_keys($array);
            for($i=0;$i<count($array);$i=$i+1){
                if($array[$key[$i]]==$max){
                    echo($key[$i]."\n");
                }
            }
        }
    }else{
        echo("輸入未符合要求");
    }
    echo("\n".PHP_EOL);

    $memoryAfter=memory_get_usage();
    $memoryDifference=$memoryAfter-$memoryBefore;
    echo("memory used: ".($memoryDifference/1048576)."MB");
?>
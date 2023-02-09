<?php
    $memoryBefore=memory_get_usage();
    echo("p12\n");
    $input_lines=trim(fgets(STDIN));
    if(1<=$input_lines&&$input_lines<=10){
        for($i=0;$i<$input_lines;$i=$i+1){
            $n=trim(fgets(STDIN));
            $num=explode(" ",trim(fgets(STDIN)));
            if(1<=$n&&$n<=100){
                rsort($num);
                for($j=0;$j<$n;$j++){
                    if($num[$j]<9){
                        $num[$j]++;
                        for($k=$j-1;$k>=0;$k--) {
                            $num[$k]=0;
                        }
                        break;
                    }
                }
                if($j >= $n) {
                    echo("1");
                    for($k=0;$k<$n-1;$k++){
                        echo "0";
                    }
                } else {
                    echo implode("",$num);
                }
                echo "\n";
            }else{
                echo("輸入未符合要求");
            }
        }
    }else{
        echo("輸入未符合要求");
    }
    echo("\n");
    $memoryAfter=memory_get_usage();
    $memoryDifference=$memoryAfter-$memoryBefore;
    echo("Memory used: ".($memoryDifference/1048576)."MB");
?>
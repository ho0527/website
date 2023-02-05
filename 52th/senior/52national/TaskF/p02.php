<?php
    $memoryBefore=memory_get_usage();
    echo("p02\n");
    function is_prime($num){
        if(($num<1)&&($num>(2**31-1))){//判斷是否再要求內
            return false;
        }else{
            $all=0;
            for($i=1;$i<=$num;$i=$i+1){
                if($num%$i==0){//判斷是否是num因數
                    $all=$all+1;
                }
            }
            if($all<=2){//判斷是否為質數
                return true;
            }else{
                return false;
            }
        }
    }
    $n=trim(fgets(STDIN));
    $num=[];
    for($i=0;$i<$n;$i=$i+1){
        $num[]=trim(fgets(STDIN));
    }
    for($i=0;$i<count($num);$i=$i+1){
        if(is_prime($num[$i])){
            echo("output".($i+1)."=>"."Y".PHP_EOL);
        }else{
            echo("output".($i+1)."=>"."N".PHP_EOL);
        }
    }
    echo("\n");
    $memoryAfter=memory_get_usage();
    $memoryDifference=$memoryAfter-$memoryBefore;
    echo("Memory used: ".($memoryDifference/1048576)."MB");
?>
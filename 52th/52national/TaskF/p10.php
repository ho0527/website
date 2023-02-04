<?php
    $memoryBefore=memory_get_usage();
    echo("p10\n");
    function checkLuhn($number){
        $sum=0;
        $odd=strlen($number) % 2;
        for($i=0;$i<strlen($number);$i=$i+1){
            $digit=(int) $number[$i];
            if(($i+$odd)%2==0){
                $digit=$digit*2;
            }
            if($digit>9){
               $sum=$sum+$digit-9;
            } else{
               $sum=$sum+$digit;
            }
        }
        return($sum % 10)==0;
    }

    $input=trim(fgets(STDIN));
    $n=(int)$input;
    for($i=0;$i<$n;$i=$i+1){
        $input=trim(fgets(STDIN));
        $input=preg_replace("/[^\d]/","",$input);
        if(checkLuhn($input)){
            echo("Y".PHP_EOL);
        }else{
            echo("N".PHP_EOL);
        }
    }
    echo("\n");
    $memoryAfter=memory_get_usage();
    $memoryDifference=$memoryAfter-$memoryBefore;
    echo("Memory used: ".($memoryDifference/1048576)."MB");
?>
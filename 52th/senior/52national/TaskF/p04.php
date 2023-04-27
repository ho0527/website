<?php
    $memoryBefore=memory_get_usage();

    echo("p04\n");
    $id=fgets(STDIN);
    $citymap=["A"=>"10","B"=>"11","C"=>"12","D"=>"13","E"=>"14","F"=>"15","G"=>"16","H"=>"17","I"=>"34","J"=>"18","K"=>"19","L"=>"20","M"=>"21","N"=>"22","O"=>"35","P"=>"23","Q"=>"24","R"=>"25","S"=>"26","T"=>"27","U"=>"28","V"=>"29","W"=>"32","X"=>"30","Y"=>"31","Z"=>"33"];
    $sum=0;
    $citycode=$id[0];
    $idcode=$citymap[$citycode];
    $sum=$sum+((int)($citymap[$citycode][0])+((int)($citymap[$citycode][1])*9));
    if($id[1]=="1"||$id[1]=="2"){
        for($i=1;$i<9;$i=$i+1){
            $sum=$sum+((int)($id[$i])*(9-$i));
        }
        $sum=$sum+(int)($id[9]);
    }else{
        $sum=-1;
    }
    if($sum%10==0){
        echo("Y".PHP_EOL);
    }else{
        echo("N".PHP_EOL);
    }

    $memoryAfter=memory_get_usage();
    $memoryDifference=$memoryAfter-$memoryBefore;
    echo("memory used ".($memoryDifference/1048576)."MB");
?>
<?php
    $memorybefore=memory_get_usage();

    echo("p01\n");

    $data=[];
    $ans=0;

    for($i=0;$i<15;$i=$i+1){
        $data[]=str_split(trim(fgets(STDIN)));
    }



    print_r($data);

    $memoryafter=memory_get_usage();
    $memorydifference=$memoryafter-$memorybefore;
    echo("memory used ".($memorydifference/1048576)."MB");
?>
<?php
    $memorybefore=memory_get_usage();

    echo("p04\n");

    function f1(){

    }

    function f2($ta,$tb){
        $count=0;
        for($i=0;$i<max(count($ta),count($tb));$i=$i+1){
            if(count($ta)<=$i){ break; }
            if(count($tb)<=$i){ break; }
            if($ta[count($ta)-1-$i]!=$tb[count($tb)-1-$i]){ $count=$count+1; }
        }
        $count=$count+abs(count($ta)-count($tb));
        return $count;
    }

    // echo(f2(["2","1","3"],["2","3"]).PHP_EOL);

    $maindata=[];
    $data=explode(" ",trim(fgets(STDIN)));
    $n=$data[0];
    $l=$data[1];
    $v0=explode(" ",trim(fgets(STDIN)));
    if(count($v0)==$l){
        $a=trim(fgets(STDIN));
        if($a==1){
            for($i=0;$i<$n;$i=$i+1){
                $maindata[]=explode(" ",trim(fgets(STDIN)));
            }
            f1();
        }elseif($a==2){
            for($i=0;$i<$n;$i=$i+1){
                $maindata[]=explode(" ",trim(fgets(STDIN)));
            }
            f2();
        }else{ echo("ERROR".PHP_EOL); }
    }else{ echo("ERROR".PHP_EOL); }

    $memoryafter=memory_get_usage();
    $memorydifference=$memoryafter-$memorybefore;
    echo("memory used ".($memorydifference/1048576)."MB");
?>
<?php
    $memorybefore=memory_get_usage();

    echo("p03\n");
    $n=(int)trim(fgets(STDIN));
    $ans=[];
    for($i=0;$i<$n;$i=$i+1){
        $num=(int)trim(fgets(STDIN));
        if(2<=$num&&$num<=((2**31)-1)){
            $factors=[];
            $divisor=2;

            while($num>1){
                if($num%$divisor==0){
                    if(!isset($factors[$divisor])){ $factors[$divisor]=0; }
                    $factors[$divisor]=$factors[$divisor]+1;
                    $num=$num/$divisor;
                }else{
                    $divisor=$divisor+1;
                }
            }

            $output="";
            $keys=array_keys($factors);
            for($j=0;$j<count($keys);$j=$j+1){
                $factor=$keys[$j];
                $count=$factors[$factor];
                if($count==1){ $output=$output.$factor."*"; }
                else{ $output=$output.$factor."^".$count."*"; }
            }
            $ans[]=rtrim($output,"*");
        }else{ $ans[]="number error"; }
    }

    for($i=0;$i<count($ans);$i=$i+1){
        echo($ans[$i].PHP_EOL);
    }

    $memoryafter=memory_get_usage();
    $memorydifference=$memoryafter-$memorybefore;
    echo("memory used ".($memorydifference/1048576)."MB");
?>
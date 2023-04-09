<?php
    $memoryBefore=memory_get_usage();
    echo("p12\n");

    function bruh($ans=[],$numi=[]){
        global $temp;
        if(count($ans)==0){
            $temp[]=implode('',$numi);
        }
        foreach($ans as $k => $v){
            $new_data=$ans;
            $new_ar=$numi;
            array_splice($new_data,$k,1);
            $new_ar[]=$v;
            bruh($new_data,$new_ar);
        }
    }

    function bla($ans,$value){
        sort($ans);
        $numi=array_unique($ans);
        $numi=array_values($numi);
        $index=array_search($value,$numi);
        return $numi[($index+1)%count($numi)];
    }

    $m=trim(fgets(STDIN));
    $ans=[];

    if(1<=$m&&$m<=10){
        for($i=0;$i<$m;$i=$i+1){
            $n=trim(fgets(STDIN));
            if(1<=$n&&$n<=100){
                $num=explode(" ",trim(fgets(STDIN)));
                $numi=[];
                for($j=0;$j<$n;$j=$j+1){
                    if(1<=$num[$j]&&$num[$j]<=9){
                        $numi[]=$num[$j];
                    }else{
                        $ans[]="輸入未符合要求(num[i])";
                    }
                }
                $temp=[];
                bruh($numi);
                $ans[]=bla($temp,implode("",$num));
            }else{
                $ans[]="輸入未符合要求(n)";
            }
        }

        for($i=0;$i<count($ans);$i=$i+1){
            echo($ans[$i]."\n");
        }
    }else{
        echo("輸入未符合要求(m)");
    }

    $memoryAfter=memory_get_usage();
    $memoryDifference=$memoryAfter-$memoryBefore;
    echo("memory used: ".($memoryDifference/1048576)."MB");
?>
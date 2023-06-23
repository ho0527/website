<?php
    $memoryBefore=memory_get_usage();

    echo("p02\n");

    // 读取输入
    $m=(int)trim(fgets(STDIN));
    $data=[];
    $maindata=[];
    $main=[];
    $ans=[];

    for($i=0;$i<$m;$i=$i+1){
        $data[]=trim(fgets(STDIN));
    }

    $n=(int)trim(fgets(STDIN));
    for($i=0;$i<$n;$i=$i+1){
        $maindata[]=trim(fgets(STDIN));
    }

    // 解析原料和价格
    for($i=0;$i<$n;$i=$i+1){
        $tokens=explode(" ",$maindata[$i]);
        $aspect=$tokens[0];
        $materialName=$tokens[1];
        $price=(int)$tokens[2];

        if(!isset($main[$aspect])){
            $main[$aspect]=[];
        }

        $main[$aspect][$materialName]=$price;
    }

    // 生成所有可能的方案
    $stack=[['index' => 0,'currentSolution' => '']];
    while(!empty($stack)){
        $current=array_pop($stack);
        $index=$current['index'];
        $currentSolution=$current['currentSolution'];

        if($index==$m){
            $ans[]=$currentSolution;
        }else{
            $aspect=$data[$index];
            $maindata=$main[$aspect];
            $materialNames=array_keys($maindata);

            for($i=0;$i<count($materialNames);$i=$i+1){
                $materialName=$materialNames[$i];
                $newSolution=$currentSolution . $materialName . " ";
                $stack[]=['index' => $index + 1,'currentSolution' => $newSolution];
            }
        }
    }

    // 根据总花费排序
    usort($ans,function($a,$b){
        $totalCostA=(int)substr($a,0,strpos($a," "));
        $totalCostB=(int)substr($b,0,strpos($b," "));

        if($totalCostA==$totalCostB){
            return strcmp($a,$b);
        }

        return $totalCostA - $totalCostB;
    });

    // 输出结果
    for($i=0;$i<count($ans);$i=$i+1){
        echo $ans[$i] . "\n";
    }

    $memoryAfter=memory_get_usage();
    $memoryDifference=$memoryAfter-$memoryBefore;
    echo("memory used ".($memoryDifference/1048576)."MB");
?>
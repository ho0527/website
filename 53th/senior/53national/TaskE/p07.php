<?php
    $memorybefore=memory_get_usage();

    echo("p07\n");

    // 讀取起始單字和終止單字
    $word=explode(" ",trim(fgets(STDIN)));
    $start=$word[0];
    $end=$word[1];

    // 讀取單字表數量和單字表
    $n=(int)trim(fgets(STDIN));
    $data=[];
    $worddata=[];

    for($i=0;$i<$n;$i=$i+1){
        $data[]=trim(fgets(STDIN));
    }

    $maindata=[];
    $ans=0;

    // 建立單字圖
    for($i=0;$i<count($data);$i=$i+1){
        for($j=0;$j<strlen($start);$j=$j+1){
            $count=0;
            for($k=0;$k<strlen($data[$i]);$k=$k+1){
                if($start[$j]!=$data[$i][$k]){
                    $count=$count+1;
                }
            }
            if($count==1){ $maindata[]=$data[$i]; }
        }
    }

    // 輸出結果
    echo($ans.PHP_EOL);

    $memoryafter=memory_get_usage();
    $memorydifference=$memoryafter-$memorybefore;
    echo("memory used ".($memorydifference/1048576)."MB");
?>
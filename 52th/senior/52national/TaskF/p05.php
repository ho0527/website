<?php
    $memoryBefore=memory_get_usage();
    echo("p05\n");
    $matrix1=explode(" ",trim(fgets(STDIN)));//第1矩陣
    $matrix2=explode(" ",trim(fgets(STDIN)));//第2矩陣
    $len1=count($matrix1);
    $len2=count($matrix2);
    for($i=0;$i<max($len1,$len2);$i=$i+1){//最大值
        if(isset($matrix1[$i])){
            $sum[$i]=$matrix1[$i];
        }else{
            $sum[$i]=0;
        }
        if(isset($matrix2[$i])){
            $sum[$i]=$sum[$i]+$matrix2[$i];
        }else{
            $sum[$i]=$sum[$i]+0;
        }
    }
    echo("output: \n");
    echo(implode(" ",$sum));
    echo("\n");
    $memoryAfter=memory_get_usage();
    $memoryDifference=$memoryAfter-$memoryBefore;
    echo("Memory used: ".($memoryDifference/1048576)."MB");
    /*
    "explode" 和 "implode" 都是 PHP 內建的字串函式。

    "explode" 是將字串分割成陣列的函式，例如：

    $str = "apple,banana,cherry";
    $fruits = explode(",", $str);

    結果是 $fruits 陣列將包含三個元素："apple"，"banana"，"cherry"。

    "implode" 是將陣列合併成字串的函式，例如：

    $fruits = array("apple", "banana", "cherry");
    $str = implode(",", $fruits);

    結果是 $str 變數將包含字串："apple,banana,cherry"。
    */
?>

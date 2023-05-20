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
            // f2();
        }else{ echo("ERROR".PHP_EOL); }
    }else{ echo("ERROR".PHP_EOL); }

    $memoryafter=memory_get_usage();
    $memorydifference=$memoryafter-$memorybefore;
    echo("memory used ".($memorydifference/1048576)."MB");
?>



// // 計算歐幾里得距離
// function euclideanDistance($v1, $v2) {
//     $distance = 0;
//     $length = count($v1);

//     for ($i = 0; $i < $length; $i++) {
//         $distance += pow($v1[$i] - $v2[$i], 2);
//     }

//     return sqrt($distance);
// }

// // 計算漢明距離
// function hammingDistance($v1, $v2) {
//     $distance = 0;
//     $length = count($v1);

//     for ($i = 0; $i < $length; $i++) {
//         if ($v1[$i] != $v2[$i]) {
//             $distance++;
//         }
//     }

//     return $distance;
// }

// // 讀取向量數量和向量長度
// list($N, $L) = explode(" ", trim(fgets(STDIN)));

// // 讀取向量 V0
// $V0 = explode(" ", trim(fgets(STDIN)));

// // 讀取距離演算法
// $A = intval(trim(fgets(STDIN)));

// // 初始化最小距離和對應的向量索引
// $minDistance = PHP_INT_MAX;
// $closestIndex = -1;

// // 讀取其他向量並計算距離
// for ($i = 0; $i < $N; $i++) {
//     $Vi = explode(" ", trim(fgets(STDIN)));
//     $distance = 0;

//     // 使用指定的距離演算法計算距離
//     switch ($A) {
//         case 1: // 歐幾里得距離
//             $distance = euclideanDistance($V0, $Vi);
//             break;
//         case 2: // 漢明距離
//             $distance = hammingDistance($V0, $Vi);
//             break;
//     }

//     // 更新最小距離和對應的向量索引
//     if ($distance < $minDistance) {
//         $minDistance = $distance;
//         $closestIndex = $i;
//     }
// }

// // 輸出最接近的向量 Vi
// echo implode(" ", $Vi) . "\n";

?>
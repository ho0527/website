<?php
    $memoryBefore = memory_get_usage();

    echo ("p02\n");

    $materialcount=trim(fgets(STDIN));
    $materiallist=[];
    $datalist=[];
    $anslist=[];
    for($i=0;$i<$materialcount;$i=$i+1){
        $materiallist[]=trim(fgets(STDIN));
    }

    $datacount=trim(fgets(STDIN));
    for($i=0;$i<$datacount;$i=$i+1){
        $data=explode(" ",trim(fgets(STDIN)));
        $datalist[$data[0]]=[$data[1],$data[2]];
    }

    $materialsArr = [];
    $materialIndex = 0;
    for ($i = 0; $i < $n; $i++) {
        $material = explode(" ", $rawMaterials[$i]);
        $materialName = $material[0];
        $materialData = [];
        $materialData[] = $material[1];
        $materialData[] = intval($material[2]);

        if ($materialIndex >= $m) {
            $materialIndex = 0;
        }

        if (!isset($materialsArr[$materials[$materialIndex]])) {
            $materialsArr[$materials[$materialIndex]] = [];
        }

        $materialsArr[$materials[$materialIndex]][] = $materialData;
        $materialIndex++;
    }

    // 生成方案
    $plans = [];
    $stack = [];
    $selectedMaterials = [];
    $currentMaterialIndex = 0;
    while (true) {
        if ($currentMaterialIndex >= $m) {
            // 生成方案的递归终止条件
            $plan = implode(" ", $selectedMaterials);
            $totalCost = 0;
            foreach ($selectedMaterials as $selectedMaterial) {
                $totalCost += $selectedMaterial[1];
            }
            $plans[$totalCost][] = $plan;

            if (empty($stack)) {
                break;
            }

            // 回溯到上一级面向的下一个原料
            $currentMaterialIndex = array_pop($stack);
            array_pop($selectedMaterials);
            continue;
        }

        $currentMaterial = $materials[$currentMaterialIndex];
        if (!isset($materialsArr[$currentMaterial])) {
            $currentMaterialIndex++;
            continue;
        }

        $materialList = $materialsArr[$currentMaterial];
        if (empty($materialList)) {
            $currentMaterialIndex++;
            continue;
        }

        $currentMaterialData = array_shift($materialList);
        $stack[] = $currentMaterialIndex;
        $selectedMaterials[] = $currentMaterialData;
        $currentMaterialIndex++;
    }

    // 排序方案
    ksort($plans);

    // 输出结果
    foreach ($plans as $totalCost => $planList) {
        foreach ($planList as $plan) {
            echo $totalCost . " " . $plan . "\n";
        }
    }

    $memoryAfter = memory_get_usage();
    $memoryDifference = $memoryAfter - $memoryBefore;
    echo ("memory used " . ($memoryDifference / 1048576) . "MB");
?>
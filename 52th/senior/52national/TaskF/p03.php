<?php
    $memoryBefore=memory_get_usage();
    echo("p03\n");
    $k=(int)(fgets(STDIN));
    $ciphertext=trim(fgets(STDIN));
    $plaintext="";
    for($i=0;$i<strlen($ciphertext);$i=$i+1){
        $plaintext=$plaintext.chr((ord($ciphertext[$i])+26-$k)%26+97);
    }
    echo($plaintext.PHP_EOL);
    $memoryAfter=memory_get_usage();
    $memoryDifference=$memoryAfter-$memoryBefore;
    echo("Memory used: ".($memoryDifference/1048576)."MB");
    /*
    這段程式碼讀取兩行輸入，第一行為加密的整數 K，第二行為要解密的字串。接著，使用迴圈對每個字元進行解密：
    使用 ord 函數將字元轉換為 ASCII 碼。
    將 ASCII 碼減去 K。
    加上 26 將結果限制在 ASCII 碼中可列印的範圍內。
    使用 chr 函數將結果轉換回字元。
    將解密後的字元附加到空字串中。
    */
?>
<?php
    $memoryBefore=memory_get_usage();
    echo("p11\n");
    $n=(int)fgets(STDIN);
    $data=[];
    $ans=[];
    for($i=0;$i<$n;$i=$i+1){
        $s=trim(fgets(STDIN));
        echo($s."\n");
        $count=0;
        if(preg_match("/[0-9]/",$s)){
            $count=$count+1;
        }
        if(preg_match("/[A-Z]/",$s)){
            $count=$count+1;
        }
        if(preg_match("/[a-z]/",$s)){
            $count=$count+1;
        }
        if(preg_match("/\~|\!|\@|\#|\$|\%|\^|\&|\*|\(|\)|\_|\+|\=|\-|\\|\||\'|\;|\"|\:|\/|\.|\,|\?|\>|\</",$s)){
        //!FIXME:
            $count=$count+1;
        }
        $ans[]=$count;
    }
    for($i=0;$i<count($ans);$i=$i+1){
        echo("output".($i+1)."=>".$ans[$i]."\n");
    }
    echo("\n");
    $memoryAfter=memory_get_usage();
    $memoryDifference=$memoryAfter-$memoryBefore;
    echo("Memory used: ".($memoryDifference/1048576)."MB");
?>
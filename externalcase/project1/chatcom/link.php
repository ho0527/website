<?php
    function blockall($name){
        return preg_match("/([ ,\!,\@,\#,\$,\%,\^,\&,\*,\(,\),\_,\-,\+,\=,\{,\},\[,\],\|,\\\,\:,\;,\',\",\<,\>,\,,\.,\?,\/ ])/",$name);
    }

    function blockslash($name){
        return preg_match("/([ \/,\\\ ])/",$name);
    }
?>
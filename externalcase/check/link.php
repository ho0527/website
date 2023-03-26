<?php
    $db=new PDO("mysql:host=localhost;dbname=check;charset=utf8","admin","1234");
    $dbuser=new PDO("mysql:host=localhost;dbname=checkuser;charset=utf8","admin","1234");
    date_default_timezone_set("Asia/Taipei");
    $time=date("Y-m-d H:i:s");
    session_start();

    function query($db,$data){
        return $db->query($data);
    }

    function fetch($data){
        return $data->fetch();
    }

    function fetchall($data){
        return $data->fetchall();
    }

    function block($name){
        return preg_match("/([ ,\!,\@,\#,\$,\%,\^,\&,\*,\(,\),\_,\-,\+,\=,\{,\},\[,\],\|,\\\,\:,\;,\",\',\<,\>,\,,\.,\?,\/ ])/",$name);
    }

    if(isset($_GET["logout"])){
        $data=$_SESSION["data"];
        if($row=fetch(query($dbuser,"SELECT*FROM `user` WHERE `number`='$data'"))){
            query($dbuser,"INSERT INTO `data`(`number`,`move`,`time`)VALUES('$row[1]','登出成功','$time')");
        }else{
            query($dbuser,"INSERT INTO `data`(`number`,`move`,`time`)VALUES('未知','登出成功','$time')");
        }
        session_unset();
        ?><script>alert("登出成功");location.href="index.php"</script><?php
    }

    function inserttable($db,$tablename,$type){
        if($type=="new"){
            query($db,"CREATE TABLE `$tablename`(`id` INT(15) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                `item` TEXT NOT NULL,
                `objective` TEXT NOT NULL,
                `description` TEXT NOT NULL,
                `score` INT(15) NOT NULL,
                `module` INT(15) NOT NULL,
                `date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            )");
        }elseif($type=="score"){
            query($db,"CREATE TABLE `$tablename`(`id` INT(15) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                `item` TEXT NOT NULL,
                `objective` TEXT NOT NULL,
                `description` TEXT NOT NULL,
                `score` INT(15) NOT NULL,
                `inputscore` INT(15) NOT NULL,
                `remark` TEXT NOT NULL,
                `module` INT(15) NOT NULL,
                `date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            )");
        }elseif($type=="correct"){
            query($db,"CREATE TABLE `$tablename`(`id` INT(15) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                `item` TEXT NOT NULL,
                `objective` TEXT NOT NULL,
                `description` TEXT NOT NULL,
                `correct` TEXT NOT NULL,
                `remark` TEXT NOT NULL,
                `module` INT(15) NOT NULL,
                `date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            )");
        }else{
            ?><script>alert("[ERROR]insert type error")</script><?php
        }
    }

    function showtable($db){
        $result=query($db,"SHOW TABLES");
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo $row["Tables_in_myDB"]. "<br>";
            }
        } else {
            echo "0 results";
        }
    }

    function checktable($db,$testdata,$true){
        if($true){
            $row=fetchall(query($db,"SELECT*FROM `main`"));
            for($i=0;$i<count($testdata);$i=$i+1){
                $test="no";
                for($j=0;$j<count($row);$j=$j+1){
                    if($testdata[$i][0]==$row[$j][1]){
                        $test="yes";
                    }
                }
                if($test=="no"&&$testdata[$i][0]!="main"){
                    ?><input type="button" onclick="location.href='?table=<?= $testdata[$i][0] ?>'" value="<?= $testdata[$i][0] ?>"><br><br><?php
                }
            }
        }else{
            $row=fetchall(query($db,"SELECT*FROM `main`"));
            for($i=0;$i<count($testdata);$i=$i+1){
                $test="no";
                for($j=0;$j<count($row);$j=$j+1){
                    if($testdata[$i][0]==$row[$j][1]){
                        $test="yes";
                    }
                }
                if($test=="yes"&&$testdata[$i][0]!="main"){
                    ?><input type="button" onclick="location.href='?table=<?= $testdata[$i][0] ?>'" value="<?= $testdata[$i][0] ?>"><br><br><?php
                }
            }
        }
    }
?>
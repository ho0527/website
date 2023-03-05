<?php
    $db=new PDO("mysql:host=localhost;dbname=check;charset=utf8","admin","1234");
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

    function inserttable($db,$tablename,$type){
        if($type=="new"){
            query($db,"CREATE TABLE `$tablename`(`id` INT(15) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                `item` TEXT NOT NULL,
                `objective` TEXT NOT NULL,
                `description` TEXT NOT NULL,
                `score` INT(15) NOT NULL,
                `remark` TEXT NOT NULL,
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
                `subjectivesuggestion` TEXT NOT NULL,
                `othersuggestion` TEXT NOT NULL,
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
                `subjectivesuggestion` TEXT NOT NULL,
                `othersuggestion` TEXT NOT NULL,
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
?>
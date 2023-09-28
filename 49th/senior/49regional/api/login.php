<?php
    include("../link.php");
    if(isset($_POST["submit"])){
        // if(!isset($_SESSION["error"])){
        //     $_SESSION["error"]=0;
        // }
        $username=$_POST["username"];
        $password=$_POST["password"];
        if($row=query($db,"SELECT*FROM `user` WHERE `username`='$username'")){
            $row=$row[0];
            if($row[3]==$password){
                if($_SESSION["verifycode"]==$_POST["verifycode"]){
                    echo(json_encode([
                        "success"=>true,
                        "data"=>[
                            "id"=>$row[0],
                            "permission"=>$row[5]
                        ],
                    ]));
                }else{
                    echo(json_encode([
                        "success"=>false,
                        "data"=>"圖形驗證碼有誤",
                    ]));
                }
            }else{
                echo(json_encode([
                    "success"=>false,
                    "data"=>"密碼有誤",
                ]));
            }
        }else{
            echo(json_encode([
                "success"=>false,
                "data"=>"帳號有誤",
            ]));
        }
    }else{
        echo(json_encode([
            "success"=>false,
            "data"=>"未知錯誤請重新登入",
        ]));
    }
?>
<?php
    @header("Content-Type:text/html;charset=utf-8");

    @include_once("conn.php");   // 引入conn.php (链接mysql)
    @include_once("common.php");


    if(!isset($_GET["email"])){
        paramsErr();
    }   


    $email = $_GET["email"];
    
    $sql = "select * from  `userinfo` where email = '$email'";
    $result = mysqli_query($conn,$sql);

    $obj = array();
    if($result){ // 判断查询的结果

        $item = mysqli_fetch_assoc($result);
        if(!$item){  // $item==false  该用户不存在
            $obj["status"] = true;
            $obj["msg"] = "可以使用的邮箱";
        }else{
            $obj["status"] = false;
            $obj["msg"] = "邮箱已注册";
        }
    }else{
        $obj["status"] = false;
        $obj["msg"] = "sql语句有误";
        $obj["sql"] = $sql;
    }
    echo json_encode($obj);

?>
<?php
    @header("Content-Type:text/html;charset=utf-8");

    @include_once("conn.php");   // 引入conn.php (链接mysql)
    @include_once("common.php");


    if(!isset($_GET["phone"])){
        paramsErr();
    }   


    $phone = $_GET["phone"];
    
    $sql = "select * from  `userinfo` where phone = '$phone'";
    $result = mysqli_query($conn,$sql);

    $obj = array();
    if($result){ // 判断查询的结果

        $item = mysqli_fetch_assoc($result);
        if(!$item){  // $item==false  该用户不存在
            $obj["status"] = true;
            $obj["msg"] = "可以使用的手机号";
        }else{
            $obj["status"] = false;
            $obj["msg"] = "手机号已注册";
        }
    }else{
        $obj["status"] = false;
        $obj["msg"] = "sql语句有误";
        $obj["sql"] = $sql;
    }
    echo json_encode($obj);

?>
<?php
    @header("Content-Type:text/html;charset=utf-8");

    @include_once("conn.php");   // 引入conn.php (链接mysql)
    @include_once("common.php");

     // 接收参数之前  判断是否存在该字段?  不存在 => 报错,阻止脚本继续向后执行
     if(!isset($_GET["id"])){ // isset($_GET["id"]) 么有id字段?
        paramsErr();
    }


    $id = $_GET["id"];

   
    $sql = "select id,name,class,chinese,math,english from `grade` where id = $id";
    $result = mysqli_query($conn,$sql);

    $obj = array();
    if($result){ // 判断查询的结果

        $item = mysqli_fetch_assoc($result);
        if($item){
            $obj["status"] = true;
            $obj["msg"] = "success";

            // 数据的预处理
            $item["chinese"] = $item["chinese"]*1;
            $item["math"] = $item["math"]*1;
            $item["english"] = $item["english"]*1;

            $obj["data"] = $item;
            
        }else{
            $obj["status"] = false;
            $obj["msg"] = "查询的用户不存在";
            $obj["sql"] = $sql;
        }
    }else{
        $obj["status"] = false;
        $obj["msg"] = "sql语句有误";
        $obj["sql"] = $sql;
    }
    // echo 111111;
    echo json_encode($obj);
?>
<?php
    @header("Content-Type:text/html;charset=utf-8");

    @include_once("conn.php");   // 引入conn.php (链接mysql)
    @include_once("common.php");

     // 接收参数之前  判断是否存在该字段?  不存在 => 报错,阻止脚本继续向后执行
     if(!isset($_GET["gid"])){ // isset($_GET["id"]) 么有id字段?
        paramsErr();
    }


    $gid = $_GET["gid"];

   
    $sql = "select * from `goodslist` where goodsId = '$gid'";
    $result = mysqli_query($conn,$sql);

    $obj = array();
    if($result){ // 判断查询的结果

        $item = mysqli_fetch_assoc($result);
        if($item){
            $obj["status"] = true;
            $obj["msg"] = "success";

            // 数据的预处理
            $smallList = explode(",",$item["smallPicList"]);   // 将字符串拆分为数组
            $item["smallPicList"] = array_slice($smallList,0,5);  // 取前五个

            $bigList = explode(",",$item["bigPicList"]);   // 将字符串拆分为数组
            $item["bigPicList"] = array_slice($bigList,0,5);  // 取前五个

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
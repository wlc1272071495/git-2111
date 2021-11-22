<?php
    @header("Content-Type:text/html;charset=utf-8");

    @include_once("conn.php");   // 引入conn.php (链接mysql)
    @include_once("common.php");


    if(!(isset($_GET["key"]) && isset($_GET["orderCol"]) && isset($_GET["orderType"]))){
        paramsErr();
    }

    $key = $_GET["key"];
    $orderCol = $_GET["orderCol"];  // 排序的列名 (id,chinese,math,english total)
    $orderType = $_GET["orderType"]; //排序的方式 (asc desc)

    $sql = "select id,name,class,chinese,math,english,chinese+math+english as total from `grade` where name like '%$key%' order by $orderCol $orderType";
    $result = mysqli_query($conn,$sql);

    $obj = array();
    if($result){ // 判断查询的结果

        $list = array();
        while($item = mysqli_fetch_assoc($result)){  // 循环解析数据  有数据 => 继续解析,没有数据=> false => 跳出循环
            // 数据的预处理
            $item["chinese"] = $item["chinese"]*1;
            $item["math"] = $item["math"]*1;
            $item["english"] = $item["english"]*1;
            $item["total"] = $item["total"]*1;
            array_push($list,$item);
        }

        $obj["status"] = true;
        $obj["msg"] = "success";
        $obj["list"] = $list;
    }else{
        $obj["status"] = false;
        $obj["msg"] = "sql语句有误";
        $obj["sql"] = $sql;
    }
    echo json_encode($obj);
?>
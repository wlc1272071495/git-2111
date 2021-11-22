<?php
    @header("Content-Type:text/html;charset=utf-8");

    @include_once("conn.php");   // 引入conn.php (链接mysql)
    @include_once("common.php");

    $sql = "select id,goodsId,goodsName,goodsImg,goodsPrice from `goodslist` ";
    $result = mysqli_query($conn,$sql);

    $obj = array();
    if($result){ // 判断查询的结果

        $list = array();
        while($item = mysqli_fetch_assoc($result)){  // 循环解析数据  有数据 => 继续解析,没有数据=> false => 跳出循环
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
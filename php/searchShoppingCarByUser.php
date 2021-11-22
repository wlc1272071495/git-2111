<?php
    @header("Content-Type:text/html;charset=utf-8");

    @include_once("conn.php");   // 引入conn.php (链接mysql)
    @include_once("common.php");

    if(!isset($_POST["user"])){
        paramsErr();
    }   


    $user = $_POST["user"];

    $sql = "select s.id,s.user,s.gid,s.buyNum,g.goodsName,g.goodsImg,g.goodsPrice,s.buyNum*g.goodsPrice as total from `shoppingcar` as s,`goodslist` as g where s.gid = g.goodsId and user = '$user'";
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
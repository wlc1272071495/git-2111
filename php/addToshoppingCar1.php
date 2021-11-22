<?php
    @header("Content-Type:text/html;charset=utf-8");

    @include_once("conn.php");   // 引入conn.php (链接mysql)
    @include_once("common.php");

    if(!(isset($_POST["user"])&&isset($_POST["gid"])&&isset($_POST["buyNum"]))){
        paramsErr();
    }

    $user = $_POST["user"];
    $gid = $_POST["gid"];
    $buyNum = $_POST["buyNum"];
    // 问题
    // 无脑新增 => 同一个人 可以同时添加多条相同商品的数据 ?

    // 怎么解决?
    // 加入购物车之前 判断该用户 是否 买过 该商品?
    // 没买过 => 新增
    // 买过   => 数量累加

    $sql = "select * from `shoppingcar` where user = '$user' and gid = '$gid'";
    $result = mysqli_query($conn,$sql);

    $obj = array();
    if($result){ // 判断查询的结果

        $item = mysqli_fetch_assoc($result);
        if($item){  //有数据  => 买过
            $obj["status"] = true;
            $obj["msg"] = "可以使用的用户名";
        }else{ // 没有数据  没买过
            $obj["status"] = false;
            $obj["msg"] = "用户名已存在";
        }
    }else{
        $obj["status"] = false;
        $obj["msg"] = "sql语句有误";
        $obj["sql"] = $sql;
    }


    // 新增
    // $sql = "insert into `shoppingcar`(user,gid,buyNum) values('$user','$gid','$buyNum')";
    // $result = mysqli_query($conn,$sql);
  
    // $obj = array();
    // if($result){ // 判断sql执行的结果(增删改)

    //     $rows = mysqli_affected_rows($conn);

    //     if($rows > 0){
    //         $obj["status"] = true;
    //         $obj["msg"] = "加入成功";
    //     }else{  // 加入不会出现此情况
    //         $obj["status"] = false;
    //         $obj["msg"] = "加入失败,数据未改变";
    //     }
    // }else{
    //     $obj["status"] = false;
    //     $obj["msg"] = "sql语句有误";
    //     $obj["sql"] = $sql;
    // }
    echo json_encode($obj);
?>
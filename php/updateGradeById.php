<?php
    @header("Content-Type:text/html;charset=utf-8");

    @include_once("conn.php");   // 引入conn.php (链接mysql)
    @include_once("common.php");

    if(!(isset( $_POST["id"])&&isset( $_POST["ch"])&&isset( $_POST["ma"])&&isset( $_POST["en"]))){
        $obj = array();
        $obj["status"] = false;
        $obj["msg"] = "请传入完整参数";
        exit(json_encode($obj));
    }

    $id = $_POST["id"];
    $ch = $_POST["ch"];
    $ma = $_POST["ma"];
    $en = $_POST["en"];

    // mysqli_query($conn,sql)   执行传入的sql语句
    // $conn  链接对象
    // sql    sql语句

    // 返回值: 语句是否执行成功
    // 查询   (成功=> 查询的结果对象/指针对象(mysqli_result Object)   语句执行失败 => false  sql语句有误)

    // 增删改 (语句执行成功 => true(语句执行成功并不代表结果就是成功的 还要看受影响的函数)  语句执行失败 => false )

    $sql = "update `grade` set chinese = $ch , math = $ma , english = $en  where id = $id";
    $result = mysqli_query($conn,$sql);
  
    $obj = array();
    if($result){ // 判断sql执行的结果(增删改)

        // 判断受影响的函数
        // $rows = mysqli_affected_rows($conn);
        // 返回受影响的行数   
        // $rows > 0   增删改 成功
        // $rows == 0  语句执行成功,但是数据未改变  (新增不会出现此情况  删除和修改有)
        // $rows == -1  sql语句有误  (按照当前写法  无法进入此判断)

        $rows = mysqli_affected_rows($conn);

        if($rows > 0){
            $obj["status"] = true;
            $obj["msg"] = "更新成功";
        }else{  
            $obj["status"] = true;
            $obj["msg"] = "更新成功,数据未改变";
        }
    }else{
        $obj["status"] = false;
        $obj["msg"] = "sql语句有误";
        $obj["sql"] = $sql;
    }
    echo json_encode($obj);
?>
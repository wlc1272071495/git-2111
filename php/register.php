<?php
    @header("Content-Type:text/html;charset=utf-8");

    @include_once("conn.php");   // 引入conn.php (链接mysql)
    @include_once("common.php");

    if(!(isset($_POST["user"])&&isset($_POST["pwd"])&&isset($_POST["phone"])&&isset($_POST["email"]))){
        paramsErr();
    }

    $user = $_POST["user"];
    $pwd = $_POST["pwd"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];

    $sql = "insert into `userinfo`(user,pwd,phone,email) value('$user','$pwd','$phone','$email')";
    $result = mysqli_query($conn,$sql);
  
    $obj = array();
    if($result){ // 判断sql执行的结果(增删改)

        $rows = mysqli_affected_rows($conn);

        if($rows > 0){
            $obj["status"] = true;
            $obj["msg"] = "注册成功";
        }else{  // 注册不会出现此情况
            $obj["status"] = false;
            $obj["msg"] = "注册失败,数据未改变";
        }
    }else{
        $obj["status"] = false;
        $obj["msg"] = "sql语句有误";
        $obj["sql"] = $sql;
    }
    echo json_encode($obj);
?>
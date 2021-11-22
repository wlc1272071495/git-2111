<?php
    @header("Content-Type:text/html;charset=utf-8");

    @include_once("conn.php");   // 引入conn.php (链接mysql)
    @include_once("common.php");

      // 接收参数之前  判断是否存在该字段?  不存在 => 报错,阻止脚本继续向后执行
      if(!isset($_GET["id"])){ // isset($_GET["id"]) 么有id字段?
        $obj = array();
        $obj["status"] = false;
        $obj["msg"] = "请传入完整参数";
        exit(json_encode($obj));
    }


    $id = $_GET["id"];  // 可以接收一个获取多(多个用逗号分隔)

  
    $sql = "delete from `grade` where id in ($id)";
    $result = mysqli_query($conn,$sql);
  
    $obj = array();
    if($result){ // 判断sql执行的结果(增删改)


        $rows = mysqli_affected_rows($conn);

        if($rows > 0){
            $obj["status"] = true;
            $obj["msg"] = "删除成功";
        }else{  
            $obj["status"] = false;
            $obj["msg"] = "删除失败,数据不存在";
        }
    }else{
        $obj["status"] = false;
        $obj["msg"] = "sql语句有误";
        $obj["sql"] = $sql;
    }
    echo json_encode($obj);
?>
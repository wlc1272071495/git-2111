<?php
@header("Content-Type:text/json;charset=utf-8");

    @include_once("conn.php");   // 引入conn.php (链接mysql)
    @include_once("common.php");


    if(!(isset($_GET["key"]) && isset($_GET["orderCol"]) && isset($_GET["orderType"]) && isset( $_GET["pageIndex"]) && isset( $_GET["showNum"]))){
        paramsErr();
    }

    $key = $_GET["key"];
    $orderCol = $_GET["orderCol"];  // 排序的列名 (id,chinese,math,english total)
    $orderType = $_GET["orderType"]; //排序的方式 (asc desc)
    $pageIndex = $_GET["pageIndex"]; //页码()
    $showNum = $_GET["showNum"];    //每页显示多少条()

    // 第几页(前端接收)   =>   每页显示5条(前端接收)
    // 第1页   limit 0,5    =>数据 1-5   
    // 第2页   limit 5,5    =>数据 6-10   
    // 第3页   limit 10,5   =>数据 11-15   
    // 第4页   limit 15,5   =>数据 16-20   
    // $pageIndex  =>   ($pageIndex-1)*$showNum  ,$showNum 


    // 问题1: 由于数据库中数据的数量有限  $pageIndex => 可能超出临界值 (小于最小值1  大于最大值) 
    // 小于最小值: 1
    // 大于最大值:  满足条件的数据的总数量($count) / 每页显示多少条($showNum) => 向上取值 => $maxPage 

    // 问题2: 
    // 如何获取最大值?   =>  满足条件的数据的总数量($count)  => 查询

    $obj = array();
    
    $sql = "select count(*) as count from `grade` where name like '%$key%'";
    $resultAll = mysqli_query($conn,$sql);
    if($resultAll){
        $item = mysqli_fetch_assoc($resultAll);
        $count = $item["count"];
        // echo $count;

        $maxPage = ceil($count / $showNum);
        // echo $maxPage;


        // 临界值限制
        if($pageIndex > $maxPage){
            $pageIndex = $maxPage;
        }
    
        if($pageIndex < 1){
            $pageIndex = 1;
        }
    
        $skipNum = ($pageIndex-1)*$showNum;
    
        $sql = "select id,name,class,chinese,math,english,chinese+math+english as total from `grade` where name like '%$key%' order by $orderCol $orderType limit $skipNum,$showNum";
        $result = mysqli_query($conn,$sql);
    
       
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
            $obj["count"] = $count*1;  // 共多少件
            $obj["maxPage"] = $maxPage;
            $obj["currentIndex"] = $pageIndex;  // 当前页 (如果页码超出最大值 => 显示正确的页码)
            $obj["list"] = $list;
        }else{
            $obj["status"] = false;
            $obj["msg"] = "sql语句有误";
            $obj["sql"] = $sql;
        }

    }else{
        $obj["status"] = false;
        $obj["msg"] = "sql语句有误";
        $obj["sql"] = $sql;
    }

    echo json_encode($obj);
?>
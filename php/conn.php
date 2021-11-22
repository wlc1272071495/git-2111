<?php
    @header("Content-Type:text/json;charset=utf-8");
    // 如何配置CORS?
    @header("Access-Control-Allow-Origin:*");  //允许所有人访问
    // @header("Access-Control-Allow-Origin:http://127.0.0.1:8848");  //允许所有人访问
    // @header("Access-Control-Allow-Origin:http://192.168.60.143");  //允许所有人访问

    //简写  
    // const HOST = "localhost:3306";
    // const USER = "root";
    // const PASSWORD = "root";
    // const DBNAME = "2111";

    const HOST = "b-l2gp4j9hdenfq3.bch.rds.bj.baidubce.com:3306";
    const USER = "b_l2gp4j9hdenfq3";
    const PASSWORD = "12345678";
    const DBNAME = "b_l2gp4j9hdenfq3";

    $conn = mysqli_connect(HOST,USER,PASSWORD,DBNAME);  

    if(!$conn){
        exit("数据库链接失败");
    }

    // 转码设置   兼容低版本
    mysqli_query($conn,"set names utf8"); // 从数据库取数据时  将编码转为utf-8;  
    mysqli_query($conn,"set character set utf-8"); // 向数据库存数据时  将编码转为utf-8

?>
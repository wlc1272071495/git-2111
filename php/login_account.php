<?php
    @header("Content-Type:text/html;charset=utf-8");

    @include_once("conn.php");   // 引入conn.php (链接mysql)
    @include_once("common.php");

    if(!( isset($_POST["account"])&&isset($_POST["pwd"]) )){
        paramsErr();
    }

    // 前端传入的账号(用户名 手机号 邮箱)和密码  
    $account = $_POST["account"];
    $pwd = $_POST["pwd"];

    // $user = "a123123";
    // $pwd = "1231231";

    // 登录时进行验证  前端用户输入的用户名和密码  与  数据库中存储的用户名和密码对比?
    // 数据库中存储的用户名和密码 没有  => 查询一下
    
    $sql = "select * from  `userinfo` where user = '$account' or phone = '$account' or email = '$account' ";
    $result = mysqli_query($conn,$sql);

    $obj = array();
    if($result){ // 判断查询的结果

        $item = mysqli_fetch_assoc($result);
        if($item){ 

            if($pwd  ==  $item["pwd"]){

                // 问题?  账号登录(用户名 手机号 邮箱)  => 导致前端无法获取当前登录的用户名 => 为了标识用户身份,登录成功之后返回账号对应的用户名
                $obj["status"] = true;
                $obj["msg"] = "登陆成功!";
                $obj["user"] = $item["user"];
            }else{
                $obj["status"] = false;
                $obj["msg"] = "账号或密码有误!";
            }

        }else{
            $obj["status"] = false;
            $obj["msg"] = "该账号未注册";
        }
    }else{
        $obj["status"] = false;
        $obj["msg"] = "sql语句有误";
        $obj["sql"] = $sql;
    }
    echo json_encode($obj);




?>
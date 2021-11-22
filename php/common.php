<?php
    function paramsErr($status=false,$msg="请传入完整参数"){
        $obj = array();
        $obj["status"] = $status;
        $obj["msg"] = $msg;
        exit(json_encode($obj));
    }
?>
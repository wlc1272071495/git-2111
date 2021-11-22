
// 模拟封装 jquery的ajax方法
// $.ajax({
//     type,      // 请求的方式
//     url,       // 请求的地址
//     data,      // 请求的数据  (string/object)
//     async,     // 是否异步
//     dataType,  //  接口返回的数据类型
//     success,  //请求成功时执行的回调函数(提前订好了请求成功时要执行的内容(回调函数有一个形式参数接收数据),请求成功时执行)

// })


var $ = {
    get: function (options) {  //  {url,data,async,dataType,success}

        var { url, data = "", async = true, dataType = "text", success } = options;

        if (data instanceof Object) {  // 此方法不准确 (且听下回分解)   可以传入一个对象作为参数  => 解析该对象  => 参数数据队列
            var list = [];
            for (var key in data) {
                var val = data[key];
                var item = key + "=" + val;
                list.push(item);
            }
            // console.log(list);

            var data = list.join("&");
            // console.log(data);
        }


        var xhr = new XMLHttpRequest();

        // data ? url + "?" + data : url  有数据 就拼接,否则直接请求
        xhr.open("get", data ? url + "?" + data : url, async);

        xhr.send();

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var result = xhr.responseText;
                if (dataType == "json") {
                    result = JSON.parse(result);
                }
                // console.log(result);

                if (success) {
                    success(result);
                }

                /* var { status, msg } = result;
        
                if (status) {
                    userSpan.textContent = "√";
                    userSpan.className = "right";
                    isUserOk = true;
                } else {
                    userSpan.textContent = "用户名已存在";
                    userSpan.className = "err";
                } */

            }
        }
    },
    post: function (options) {  //  {url,data,async,dataType,success}

        var { url, data = "", async = true, dataType = "text", success } = options;

        if (data instanceof Object) {  // 此方法不准确 (且听下回分解)   可以传入一个对象作为参数  => 解析该对象  => 参数数据队列
            var list = [];
            for (var key in data) {
                var val = data[key];
                var item = key + "=" + val;
                list.push(item);
            }
            // console.log(list);

            var data = list.join("&");
            // console.log(data);
        }


        var xhr = new XMLHttpRequest();

        // data ? url + "?" + data : url  有数据 就拼接,否则直接请求
        xhr.open("post", url, async);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send(data);

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var result = xhr.responseText;
                if (dataType == "json") {
                    result = JSON.parse(result);
                }
                // console.log(result);

                // if (success) {
                //     success(result);
                // }

                success && success();

                /* var { status, msg } = result;
        
                if (status) {
                    userSpan.textContent = "√";
                    userSpan.className = "right";
                    isUserOk = true;
                } else {
                    userSpan.textContent = "用户名已存在";
                    userSpan.className = "err";
                } */

            }
        }
    },
    ajax: function (options) {  //  {url,data,async,dataType,success}
        var { type = "get", url, data = "", async = true, dataType = "text", success, error } = options;

        try {
            if (data instanceof Object) {  // 此方法不准确 (且听下回分解)   可以传入一个对象作为参数  => 解析该对象  => 参数数据队列
                var list = [];
                for (var key in data) {
                    var val = data[key];
                    var item = key + "=" + val;
                    list.push(item);
                }
                // console.log(list);

                var data = list.join("&");
                // console.log(data);
            }


            var xhr = new XMLHttpRequest();

            if (type.toLowerCase() == "get") {
                // get
                // data ? url + "?" + data : url  有数据 就拼接,否则直接请求
                xhr.open("get", data ? url + "?" + data : url, async);
                xhr.send();
            } else if (type.toLowerCase() == "post") {
                // post
                // data ? url + "?" + data : url  有数据 就拼接,否则直接请求
                xhr.open("post", url, async);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.send(data);
            }


            xhr.onreadystatechange = function () {
                try {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        var result = xhr.responseText;
                        if (dataType == "json") {
                            result = JSON.parse(result);
                        }
                        // console.log(result);

                        if (success) {
                            success(result);
                        }
                    }
                } catch (err) {
                    error && error(err);
                }
            }
        } catch (err) {
            error && error(err);
        }


    }


}

// var $ = {
//     get,
//     post,
//     ajax,
// }









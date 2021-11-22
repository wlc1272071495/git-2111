
function setCookie(key, val, day, path = "/") {
    if (day != undefined) {  // 有参数 => 设置过期时间 
        var date = new Date();
        date.setDate(date.getDate() + day);
        document.cookie = key + "=" + encodeURIComponent(val) + ";expires=" + date.toUTCString() + ";path=" + path;
    } else {  // 没有参数day  => 默认浏览器关闭过期
        document.cookie = key + "=" + encodeURIComponent(val) + ";path=" + path;
    }
}

// function getCookie(key) {
//     var cookie = document.cookie;
//     var data = {};
//     if (cookie) {
//         var list = cookie.split("; ");
//         // console.log(list);
//         for (var i = 0; i < list.length; i++) {
//             var item = list[i];  // 'user=a123123', 'pwd=123123'
//             var attr = item.split("=")[0];
//             var val = item.split("=")[1];
//             // console.log(item, attr, val);

//             data[attr] = val;
//         }
//     }
//     // 全部解析之后 在取值
//     return data[key] || "";
// }


function getCookie(key) {
    var cookie = document.cookie;
    if (cookie) {
        var list = cookie.split("; ");
        // console.log(list);
        for (var i = 0; i < list.length; i++) {
            var item = list[i];  // 'user=a123123', 'pwd=123123'
            var attr = item.split("=")[0];
            var val = item.split("=")[1];

            // 每次解析之后判断 
            if (key === attr) {
                return decodeURIComponent(val);
            }

        }
    }
    return "";
}

function deleteCookie(key) {
    setCookie(key, "", -1);
}

function clearCookie() {
    var cookie = document.cookie;
    if (cookie) {
        var list = cookie.split("; ");
        // console.log(list);
        for (var i = 0; i < list.length; i++) {
            var item = list[i];  // 'user=a123123', 'pwd=123123'
            var attr = item.split("=")[0];
            var val = item.split("=")[1];
            deleteCookie(attr);
        }
    }
}
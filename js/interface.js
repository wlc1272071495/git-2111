// 致力于将所有的接口 存储在同一个文件中

// ajax的二次封装
function request(url, params, type = "get") {  // 向指定接口发送请求  返回一个Promise实例
    return new Promise(function (resolve, reject) {
        $.ajax({
            type: type,
            url: url,
            data: {
                ...params
            },
            dataType: "json",
            success: function (result) {
                resolve(result); //请求成功就返回数据 
            },
            error: function (err) {
                reject(err);    //请求失败 =>返回错误
            }
        })
    })
}

// function isExistUser(params = {}) {  //params   考虑参数可能没有也可能有多个 对象传参{user}   
//     return request("../php/isExistUser.php", params, "get"); // 返回promise实例
// }

// const isExistUser = function (params = {}) {
//     return request("../php/isExistUser.php", params, "get");
// }
// const isExistUser = (params = {}) => {
//     return request("../php/isExistUser.php", params, "get");
// }

const isExistUser = (params = {}) => request("../php/isExistUser.php", params);
const isExistPhone = (params = {}) => request("../php/isExistPhone.php", params);
const isExistEmail = (params = {}) => request("../php/isExistEmail.php", params);
const register = (params = {}) => request("../php/register.php", params, "post");

const login = (params = {}) => request("../php/login.php", params, "post");
const loginAccount = (params = {}) => request("../php/login_account.php", params, "post");

const searchGradeOrderLimit = (params = {}) => request("../php/searchGradeOrderLimit.php", params);
const deleteGradeById = (params = {}) => request("../php/deleteGradeById.php", params);
const searchGradeById = (params = {}) => request("../php/searchGradeById.php", params);
const updateGradeById = (params = {}) => request("../php/updateGradeById.php", params, "post");


const searchAllGoods = (params = {}) => request("../php/searchAllGoods.php", params);
// const searchGoodsOrderLimit = (params = {}) => request("../php/searchAllGoodsOrderLimit.php", params);
const searchGoodsByGoodsId = (params = {}) => request("../php/searchGoodsByGoodsId.php", params);


const addToShoppingCar = (params = {}) => request("../php/addToShoppingCar.php", params, "post");
const searchShoppingCarByUser = (params = {}) => request("../php/searchShoppingCarByUser.php", params, "post");

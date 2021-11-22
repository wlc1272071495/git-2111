

$(function () {

    // searchAllGoods().then(result => {
    //     console.log(result);
    // })

    loadGoods();

    async function loadGoods() {
        var result = await searchAllGoods();
        var { status, mag, list } = result;

        if (status) {
            var html = "";
            list.forEach(({ id, goodsId, goodsName, goodsPrice, goodsImg }) => {
                html += `<li>
                <a href="../html/goodsDetail.html?gid=${goodsId}">
                    <img src="${goodsImg}"
                        alt="">
                </a>
                <p class="info">${goodsName}</p>
                <p class="price">￥<span>${goodsPrice}</span> </p>
            </li>`
            })
            $(".list").html(html);

            // 事件监听绑定   => 可以给一个元素绑定多个事件
            // $(".prev").off();
            // $(".prev").click(function () {

            // })
        }


    }


})
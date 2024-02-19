<h2 class="ct">新增商品</h2>

<form action="./api/save_goods.php" method="post" enctype="multipart/form-data">
    <table class="all">
        <tr>
            <th class="tt ct">所屬大分類</th>
            <td class="pp">
                <select name="big" id="big"></select>
            </td>
        </tr>
        <tr>
            <th class="tt ct">所屬中分類</th>
            <td class="pp">
                <select name="mid" id="mid"></select>
            </td>
        </tr>
        <tr>
            <th class="tt ct">商品編號</th>
            <td class="pp">完成分類後自動分配</td>
        </tr>
        <tr>
            <th class="tt ct">商品名稱</th>
            <td class="pp"><input type="text" name="name" value=""></td>
        </tr>
        <tr>
            <th class="tt ct">商品價格</th>
            <td class="pp"><input type="text" name="price" value=""></td>
        </tr>
        <tr>
            <th class="tt ct">規格</th>
            <td class="pp"><input type="text" name="spec" value=""></td>
        </tr>
        <tr>
            <th class="tt ct">庫存量</th>
            <td class="pp"><input type="text" name="stock" value=""></td>
        </tr>
        <tr>
            <th class="tt ct">商品圖片</th>
            <td class="pp"><input type="file" name="img" value=""></td>
        </tr>
        <tr>
            <th class="tt ct">商品介紹</th>
            <td class="pp"><textarea name="intro" style="width:80%;height:150px;"></textarea></td>
        </tr>
    </table>
    <div class="ct">
        <input type="submit" value="新增">
        <input type="reset" value="重置">
        <input type="button" value="返回">
    </div>
</form>

<script>
    // big要是0
    getTypes('big', 0)

    // 初始化大分類的下拉選單
    // 呼叫 getTypes 函數，傳遞 'big' 作為類型參數和 0 作為 big_id 參數
    $("#big").on("change", function() {
        getTypes('mid', $("#big").val())
    })

    // 事件監聽器，當大分類下拉選單 (id 為 'big') 的選項發生變化時觸發
    // 當選擇的大分類改變時，會呼叫 getTypes 函數來更新中分類的下拉選單(id 為 'mid')
    // $("#big").val() 獲取大分類下拉選單當前選擇的值
    function getTypes(type, big_id) {
        $.get("./api/get_types.php", {
            big_id
        }, (types) => {
            switch (type) {
                case 'big':
                    $("#big").html(types)
                    getTypes('mid', $("#big").val())
                    break;
                case 'mid':
                    $("#mid").html(types)
                    break;
            }
        })
    }

    // 這是一個自定義的函數 getTypes，用來從伺服器獲取並顯示大分類或中分類的選項。
    // 它接受兩個參數：type ('big' 或 'mid') 和 big_id (大分類的 id)。
    // 使用 jQuery 的 $.get 方法從 "./api/get_types.php" 獲取資料，big_id 作為請求參數。
    // 當伺服器響應後，會根據 type 參數更新對應的下拉選單。
    // 如果 type 是 'big'，則更新大分類下拉選單並遞迴呼叫 getTypes 來更新中分類選單。
    // 如果 type 是 'mid'，則僅更新中分類下拉選單。
</script>
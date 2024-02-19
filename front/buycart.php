<?php

// 如果收到了商品的 ID，將其添加到購物車中
if (isset($_GET['id'])) {
    // 將商品的 ID 和數量添加到 Session 的購物車陣列中
    $_SESSION['cart'][$_GET['id']] = $_GET['qt'];
}

// 檢查是否存在會員 Session，如果不存在，將用戶導向登入頁面
if (!isset($_SESSION['mem'])) {
    to("?do=login");
}

// 在頁面上顯示會員的購物車標題
echo "<h2 class='ct'>{$_SESSION['mem']}的購物車</h2>";

// 如果未收到任何商品的 ID，顯示購物車中尚無商品的提示
if (empty($_SESSION['cart'])) {
    echo "<h2 class='ct'>購物車中尚無商品</h2>";
}
?>

<table class="all">
    <tr class="tt ct">
        <td>編號</td>
        <td>商品名稱</td>
        <td>數量</td>
        <td>庫存量</td>
        <td>單價</td>
        <td>小計</td>
        <td>刪除</td>
    </tr>
    <?php
    // dd($_SESSION['cart']);
    foreach ($_SESSION['cart'] as $id => $qt) {
        $goods = $Goods->find($id);
    ?>
        <tr class="pp ct">
            <td><?= $goods['no']; ?></td>
            <td><?= $goods['name']; ?></td>
            <td><?= $qt; ?></td>
            <td><?= $goods['stock']; ?></td>
            <td><?= $goods['price']; ?></td>
            <td><?= $goods['price'] * $qt; ?></td>
            <td><img src="./icon/0415.jpg" onclick="delCart(<?=$id;?>)"></td>
        </tr>

    <?php
    }
    ?>
</table>
<div class="ct">
    <img src="./icon/0411.jpg" onclick="location.href='index.php'">
    <img src="./icon/0412.jpg" onclick="location.href='?do=checkout'">
</div>

<script>
    function delCart(id){
        $.post("./api/del_cart.php",{id},()=>{
            location.href="?do=buycart";
        })
    }
</script>
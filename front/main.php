<?php

// $type=0;
// if(isset($_GET['type'])){
// $type=$_GET['type'];
// }

$type = $_GET['type'] ?? 0;
$nav = '';
$goods = null;

if ($type == 0) {
    $nav = "全部商品";
    $goods = $Goods->all(['sh' => 1]);
} else {
    $t = $Type->find($type);
    // 分類大分類還是中分類
    if ($t['big_id'] == 0) {
        $nav = $t['name'];
        // 把所有商品撈出來
        $goods = $Goods->all(['sh' => 1, 'big' => $t['id']]);
    } else {
        $b = $Type->find($t['big_id']);
        $nav = $b['name'] . " > " . $t['name'];
        $goods = $Goods->all(['sh' => 1, 'mid' => $t['id']]);
    }
}

?>

<h2><?= $nav; ?></h2>
<style>
    .item {
        width: 80%;
        height: 160px;
        background-color: #f4c591;
        margin: 5px auto;
        display: flex;
    }

    .item .img {
        width: 33%;
        display: flex;
        justify-content: center;
        align-items: center;
        border: 1px solid #999;
    }

    .item .info {
        width: 67%;
        display: flex;
        flex-direction: column;
    }

    .info div {
        border: 1px solid #999;
        border-left: 0px;
        border-top: 0px;
        flex-grow: 1;
    }

    .info div:nth-child(1) {
        border-top: 1px solid #999;
    }
</style>

<?php
foreach ($goods as $good) {
    // echo $good['name'];
    // echo "<br>";
?>
    <div class="item">
        <div class="img">
            <a href="?do=detail&id=<?= $good['id']; ?>">
                <img src="./img/<?= $good['img']; ?>" style="width:80%;height:110px">
            </a>
        </div>
        <div class="info">
            <div class="ct tt"><?= $good['name']; ?></div>
            <div>
                價錢：<?= $good['price']; ?>
                <img src="./icon/0402.jpg" style="float:right" onclick="location.href='?do=buycart&id=<?= $good['id']; ?>&qt=1'">
            </div>
            <div>規格：<?= $good['spec']; ?></div>
            <div>簡介：<?= mb_substr($good['intro'], 0, 25); ?>...</div>
        </div>
    </div>
<?php
}
?>
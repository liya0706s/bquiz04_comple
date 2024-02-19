<?php
include_once "db.php";

$_POST['no']=date("Ymd").rand(100000,999999);
// 轉成字串
$_POST['cart']=serialize($_SESSION['cart']);
// 帳號
$_POST['acc']=$_SESSION['mem'];

$Orders->save($_POST);
// 完成儲存於資料庫以後，將購物車內容刪除
unset($_SESSION['cart']);

?>
<script>
    alert("訂購成功!\n感謝您的選購!");
    location.href="../index.php";
</script>
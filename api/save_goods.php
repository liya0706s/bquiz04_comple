<?php
include_once "db.php";

// 檢查是否有上傳圖片
if(!empty($_FILES['img']['tmp_name'])){
    $_POST['img']=$_FILES['img']['name'];
    move_uploaded_file($_FILES['img']['tmp_name'],"../img/{$_FILES['img']['name']}");
    // 改為對應上傳檔案的檔名
}

// 如果沒有提供商品ID
if(!isset($_POST['id'])){
    // 產生一組隨機的商品編號
  $_POST['no']=rand(100000,999999);
//   將商品預設上架
$_POST['sh']=1;  
}

// 呼叫資料庫物件的儲存方法，將商品資料存入資料庫
$Goods->save($_POST);
// 轉址至後台管理頁面的商品列表
to("../back.php?do=th");

?>
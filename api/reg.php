<?php include_once 'db.php';

// 有id只要編輯會員資料，
// 從back/edit_mem.php，沒有id要新增
if(!isset($_POST['id'])){
    $_POST['regdate']=date("Y-m-d");
}
$Mem->save($_POST);

if(isset($_POST['id'])){
    to("../back.php?do=mem");
}


?>
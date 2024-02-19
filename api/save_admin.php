<?php
include_once "db.php";

// $_POST['pr'];
// $Admin->save($_POST);
// to("../back.php?do=admin");
// 陣列轉成字串才可以存進資料庫 serialize()

$_POST['pr']=serialize($_POST['pr']);
$Admin->save($_POST);
to("../back.php?do=admin");

?>
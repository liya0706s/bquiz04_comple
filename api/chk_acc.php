<?php
// 檢查可否使用用到資料庫
include_once "db.php";

echo $Mem->count(['acc' => $_GET['acc']]);

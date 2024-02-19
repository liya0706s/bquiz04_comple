<?php
include_once "db.php";
// main的品項數量 送id和數量過來
$_SESSION['cart'][$_POST['id']]=$_POST['qt'];

echo count($_SESSION['cart']);


?>
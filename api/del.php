<?php 
include_once "db.php";

$db=new DB($_POST['table']);
$db->del($_POST['id']);

?>
<?php
$id = $_GET['id'];
$item = $_GET['item'];
$str = $_GET['str'];

$db_conn = new PDO('sqlite:../mindgath.sqlite');
$sth = $db_conn->prepare("UPDATE user SET '$item'='$str' WHERE id='$id'");
$sth->execute();
?>

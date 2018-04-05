<?php
$group_name = $_GET['group_name'];
//$db_conn = $_GET['db_conn'];
// to get the input

$db_conn = new PDO('sqlite:../mindgath.sqlite');
$sth = $db_conn->prepare("SELECT * from ".$group_name." ORDER BY id DESC LIMIT 1");
$sth->execute();
if($row2 = $sth->fetch(PDO::FETCH_ASSOC)){
  echo $row2['id'];
}
// to get the username
?>



<?php

$group_name = $_GET['group_name'];
$max_member = $_GET['max_member'];
$description = $_GET['description'];
$user_location = $_GET['user_location'];
$tag = $_GET['tag'];
$requirement = $_GET['requirement'];
// to get the input from table

$tag_result = explode(" ", $tag);
// to splite the tags into three

$date = new DateTime();
$datetime = date('m/d/Y H:i:s', $date->getTimestamp());
// to get the time of registration

$db_conn = new PDO('sqlite:../mindgath.sqlite');
$stmt = "INSERT INTO create_group (name,date,max_member,description,location,requirement,tag1,tag2,tag3) VALUES('$group_name','$datetime','$max_member','$description','$user_location','$requirement','$tag_result[0]','$tag_result[1]','$tag_result[2]')";
$db_conn->exec($stmt);
// to store data to database

?>

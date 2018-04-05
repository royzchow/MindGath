<?php
session_start();

$email = $_GET['email'];
$password = $_GET['password'];
$encrypt_password = crypt($password,9);
// to get the input from login form

$db_conn = new PDO('sqlite:../mindgath.sqlite');
$sth = $db_conn->prepare("SELECT * FROM user WHERE email='$email'");
$sth->execute();
if($row = $sth->fetch(PDO::FETCH_ASSOC)){
  $id = $row['id'];
  $password = $row['password'];
  $_SESSION["id"]=$id;
}
else{
  echo "fail";
}
// to get details from database which matched the username

if($encrypt_password == $password) {
  echo "success";
  $_SESSION["login"]=1;
  // to set the session as login
}else{
  echo "fail";
}

die();

?>

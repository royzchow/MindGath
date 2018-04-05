<?php
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$encrypt_password = crypt($password,9);
$tel = $_POST['tel'];
// to get the input from registration form

$date = new DateTime();
$datetime = date('m/d/Y H:i:s', $date->getTimestamp());
// to get the time of registration

$db_conn = new PDO('sqlite:../mindgath.sqlite');
$stmt = "INSERT INTO user(username, password, tel, email, date)
VALUES('$username', '$encrypt_password', '$tel', '$email','$datetime')";
$db_conn->exec($stmt);
// to store data to database

header("Location: ../");
die();

?>

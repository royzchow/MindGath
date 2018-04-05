<?php
$id = $_GET['id'];
$user_id = $_GET['user_id'];
$message = $_GET['message'];
$chat_id = $_GET['chat_id'];
// to get the input from registration form

$date = new DateTime();
$datetime = date('m/d/Y H:i:s', $date->getTimestamp());
// to get the time of registration

$newDate = date("h:m d M Y", strtotime($datetime));
// to return the date time

if($user_id!="get_value_only"){
  $db_conn = new PDO('sqlite:../mindgath.sqlite');
  $stmt = "INSERT INTO group_chat_".$id."(time,user_id,message)
  VALUES('$datetime', '$user_id', '$message')";
  $db_conn->exec($stmt);

  $sth = $db_conn->prepare("SELECT * FROM user WHERE id='$user_id'");
  $sth->execute();
  if($row2 = $sth->fetch(PDO::FETCH_ASSOC)){
    $username = $row2['username'];
    $return_data['username'] = $username;
    $return_data['time'] = $newDate;
    echo json_encode($return_data);
  } // to get the username
}
// to store data to database and update chatroom for speaker
else{
  $db_conn = new PDO('sqlite:../mindgath.sqlite');
  $sth = $db_conn->prepare("SELECT * FROM group_chat_".$id." WHERE id='$chat_id'");
  $sth->execute();
  if($row2 = $sth->fetch(PDO::FETCH_ASSOC)){
    $return_data['message'] = $row2['message'];
    $return_data['user_id'] = $row2['user_id'];
    $get_user_id = $row2['user_id'];
    $return_data['time'] = $newDate;

    $sth2 = $db_conn->prepare("SELECT * FROM user WHERE id='$get_user_id'");
    $sth2->execute();
    if($row3 = $sth2->fetch(PDO::FETCH_ASSOC)){
      $return_data['username'] = $row3['username'];
      echo json_encode($return_data);
    } // to get the username of the speaker
    
  } // to get the detail of a chat row
}
// to update chatroom for other user
?>

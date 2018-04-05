  <?php
  function display_group_chat($id,$db_conn){
    $sth_chat = $db_conn->prepare("SELECT * FROM (SELECT * FROM group_chat_".$id." ORDER BY id DESC LIMIT 5) tmp order by tmp.id asc");
    $sth_chat->execute();
    while($row_chat = $sth_chat->fetch(PDO::FETCH_ASSOC)){
      $message = $row_chat['message'];
      $user_id = $row_chat['user_id'];
      $time = $row_chat['time'];
      $newDate = date("h:m d M Y", strtotime($time));
      $sth_chat2 = $db_conn->prepare("SELECT * FROM user WHERE id='$user_id'");
      $sth_chat2->execute();
      if($row_chat2 = $sth_chat2->fetch(PDO::FETCH_ASSOC)){
        $username = $row_chat2['username'];
      }
      if($user_id!=$_SESSION['id']){ ?>
        <div style="font-size:10; margin-left:7px;"><span style="color:#374aae; margin-right:2px;"><?= $username ?></span> <?= $newDate ?></div>
        <div style="width:200px;border-radius:5px; padding:10px; border-radius:10px; background-color:#F5F5F5; font-size:14px; line-height:15px; margin-bottom:5px;">
          <?= $message ?>
        </div>
        <!-- other message -->
      <?php } else { ?>
        <div style="font-size:10; float:right; margin-right:40px;"><span style="color:#374aae; margin-right:2px;"><?= $username ?></span> <?= $newDate ?></div><br>
        <div style="margin-left:45px; width:200px;border-radius:5px; padding:10px; border-radius:10px; background-color:#F5F5F5; font-size:14px; line-height:15px; margin-bottom:10px;">
          <?= $message ?>
        </div>
        <!-- user message -->
      <?php } ?>
    <?php } ?>
  <?php } ?>

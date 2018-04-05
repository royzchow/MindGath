<?php
function display_group($id,$db_conn,$type){
  $sth = $db_conn->prepare("SELECT * FROM create_group WHERE id='$id'");
  $sth->execute();
  if($row = $sth->fetch(PDO::FETCH_ASSOC)){
    $group_id = $row['id'];
    $creater_id = $row['creater_id'];
    $date = $row['date'];
    $name = $row['name'];
    $max_member = $row['max_member'];
    $current_member = $row['current_member'];
    $location = $row['location'];
    $description = $row['description'];
    $tag1 = $row['tag1'];
    $tag2 = $row['tag2'];
    $tag3 = $row['tag3'];
    $requirement = $row['requirement'];
  }
  $sth = $db_conn->prepare("SELECT username FROM user WHERE id='$creater_id'");
  $sth->execute();
  if($row = $sth->fetch(PDO::FETCH_ASSOC)){
    $username = $row['username'];
  }
  $newDate = date("d M Y", strtotime($date));
  // to change the format of the date of create
  ?>

  <div id="card_basic<?= $id ?>">
    <figure class="snip1336">
      <img class="card" src="https://thetutor.hk/MindGath/image/group/<?= $group_id ?>.jpg" alt="sample87" />
      <figcaption id="move_up<?= $id ?>">
        <a href="https://thetutor.hk/MindGath/profile/index.php?id=<?= $creater_id ?>"><img src="https://thetutor.hk/MindGath/image/user_icon/<?= $creater_id ?>.jpg" alt="profile-sample4" class="profile" /></a>
        <h2><a style="color:#333; text-decoration:none;" href="https://thetutor.hk/MindGath/group/index.php?id=<?= $group_id ?>"><?= $name ?></a><span>Member: <?= $current_member ?>/<?= $max_member ?></span></h2>
        <p id="description<?= $id ?>" style="min-height:88px;max-height:88px;"><?= $description ?></p>
        <!-- to display the basic information -->
        <div id="disappear<?= $id ?>">
          <?php if($type=="home_page"){ ?><button id="show_join<?= $id ?>" onclick="show_join(<?= $id ?>)" class="follow">Join</button><?php } ?>
          <?php if($type=="group"){ ?><button id="show_chatroom<?= $id ?>" onclick="show_chatroom(<?= $id ?>)" class="follow">Chat Room</button><?php } ?>
          <button id="show_info<?= $id ?>" onclick="show_info(<?= $id ?>)" class="info">More Info</button>
        </div>
        <!-- to display the button of the card -->
        <div id="info<?= $id ?>" style="margin-top:20px; max-height:165px; min-height:165px; display:none;">
          <div id="content_info">
            <span style="color:#333;">Status:</span> Active<br><div style="height:5px;"></div>
            <span style="color:#333;">Leader:</span> <?= $username ?><br><div style="height:5px;"></div>
            <span style="color:#333;">Establish:</span> <?= $newDate ?><br><div style="height:5px;"></div>
            <span style="color:#333;">Location:</span> <?= $location ?><br><div style="height:5px;"></div>
            <span style="color:#333;">Tags:</span> <span class="tag">#<?= $tag1 ?></span> <span class="tag">#<?= $tag2 ?></span> <span class="tag">#<?= $tag3 ?></span><br><div style="height:5px;"></div>
            <span style="color:#333;">Requirmant:</span> <?= $requirement ?><br>
          </div>
        </div>
        <!-- to display the detail information -->
        <?php if($type=="home_page"){ ?>
          <div id="chatroom<?= $id ?>"></div> <!-- to allow the js to work -->
          <div id="join<?= $id ?>" style="margin-top:20px; max-height:165px; min-height:165px; display:none;">
            <div id="content_info">
              <span style="color:#333;">Message:</span><br><div style="height:8px;"></div>
              <textarea class="join" placeholder="Type your message here..."></textarea><br><div style="height:15px;"></div>
              <button style="width:100%; font-size:1em;">Send Request</button>
            </div>
          </div>
          <!-- to display the join message area -->
        <?php } ?>
      </figcaption>
    </figure>
  </div>
  <?php if($type=="group"){ ?>
    <div id="join<?= $id ?>"></div> <!-- to allow the js to work -->

    <script>
    var max_chat_id=0;
    function get_max_chat_id(){
      $.ajax({
        url: "https://thetutor.hk/MindGath/general/get_max_id.php?group_name=group_chat_"+<?= $id ?>,
        data: {action: 'test'},
        type: 'GET',
        dataType: 'json',
        success: function(output) {
          if(output>max_chat_id && max_chat_id!=0){
            for(i=max_chat_id+1;i<=output;i++){
              $.ajax({
                url: "https://thetutor.hk/MindGath/general/update_chatroom.php?id="+<?= $id ?>+"&user_id=get_value_only&chat_id="+i,
                data: {action: 'test'},
                type: 'GET',
                dataType: 'json',
                success: function(output) {
                  if(output.user_id!=<?= $_SESSION['id'] ?>){
                    $("#container<?= $id ?>").append( "<div style=\"font-size:10; margin-left:7px;\"><span style=\"color:#374aae; margin-right:2px;\">"+output.username+"</span>"+output.time+"</div>" );
                    $("#container<?= $id ?>").append( "<div style=\"width:200px;border-radius:5px; padding:10px; border-radius:10px; background-color:#F5F5F5; font-size:14px; line-height:15px; margin-bottom:5px;\">"+output.message+"</div>" );
                  }else{
                    $("#container<?= $id ?>").append( "<div style=\"font-size:10; float:right; margin-right:40px;\"><span style=\"color:#374aae; margin-right:2px;\">"+output.username+"</span>"+output.time+"</div><br>" );
                    $("#container<?= $id ?>").append( "<div style=\"margin-left:45px; width:200px;border-radius:5px; padding:10px; border-radius:10px; background-color:#F5F5F5; font-size:14px; line-height:15px; margin-bottom:10px;\">"+output.message+"</div>" );
                  }
                  $("#container<?= $id ?>").scrollTop($("#container<?= $id ?>")[0].scrollHeight); // to scroll to the bottom
                }
              });
            } // to update the chatroom for the suitable amount
          }
          max_chat_id=output; // to update the max chat id
        }
      });
    }
    // to get the max id of the chat room adn update chat room
    get_max_chat_id(); // to get the max id of the chat room when load
    setInterval(get_max_chat_id,100); // to get the max id of the chat room in every 1s
    </script>
    <!-- to deal with update chat room in every 1s -->

    <div id="chatroom<?= $id ?>">

      <figure class="snip1336">
        <img class="card" src="https://thetutor.hk/MindGath/image/group/<?= $group_id ?>.jpg" />
        <figcaption style="transform: translateY(-200px);">
          <div>
            <table style="width:285px;">
              <tr>
                <td>
                  <h2>Chat Room<span style="color:374aae; margin-left:2px;"><?= $name ?></span></h2>
                </td>
                <td style="vertical-align:top;">
                  <div style="height:15px;"></div>
                  <a onclick="show_info_from_chat(<?= $id ?>);" style="cursor:pointer"><img style="width:25px;" src="back.png"/></a>
                </td>
              </tr>
            </table>
            <!-- to display the heading of the card's chatroom -->
            <style>
              div.shadow{
                -moz-box-shadow:    inset 0 0 2px #333;
                -webkit-box-shadow: inset 0 0 2px #333;
                box-shadow:         inset 0 0 2px #333;
              }
            </style>
            <div style="height:8px;"></div>
            <div style="width:265px; background-color:white; position:absolute;" class="shadow">
              <div id="container<?= $id ?>" class="container" style="margin-top:2px; height:300px; height:287px!important; width:300px!important; overflow-y:scroll; padding:10px; margin-left:0px;"><?php display_group_chat($id,$db_conn); ?></div>
            </div>
            <div style="height:126px;"></div>
            <div style="background-color:#DDD; height:40px; position:absolute; top:372px; width:265px;">
              <input id="chat_message<?= $id ?>" style="width:255px; height:30px; padding:10px; background-color:white; border-radius:10px; border-width:1px; font-size:14px; margin-top:5px; margin-left:5px;" placeholder="Type your comment & hit Enter..."></input>
              <script>
              $("#container<?= $id ?>").scrollTop($("#container<?= $id ?>")[0].scrollHeight);
              // to scroll the chatroom to the bottom
              $("#chat_message<?= $id ?>").focus(function() {
                $( "#chat_message<?= $id ?>" ).keypress(function(e) {
                  if(e.which == 13 && $( "#chat_message<?= $id ?>" ).val()!='') {
                    var message = $( "#chat_message<?= $id ?>" ).val();
                    $( "#chat_message<?= $id ?>" ).val(''); // to clear the input bar
                    $.ajax({
                      url: "https://thetutor.hk/MindGath/general/update_chatroom.php?id="+<?= $id ?>+"&message="+message+"&user_id="+<?= $_SESSION['id'] ?>,
                      data: {action: 'test'},
                      type: 'GET',
                      dataType: 'json',
                      success: function(output) {
                        $("#container<?= $id ?>").append( "<div style=\"font-size:10; float:right; margin-right:40px;\"><span style=\"color:#374aae; margin-right:2px;\">"+output.username+"</span>"+output.time+"</div><br>" );
                        $("#container<?= $id ?>").append( "<div style=\"margin-left:45px; width:200px;border-radius:5px; padding:10px; border-radius:10px; background-color:#F5F5F5; font-size:14px; line-height:15px; margin-bottom:10px;\">"+message+"</div>" );
                        $("#container<?= $id ?>").scrollTop($("#container<?= $id ?>")[0].scrollHeight);
                        max_chat_id++; // for user not to update
                      }
                    });
                  }
                });
              }); // to handle the message output

              </script>
            </div>
          </div>
        </figcaption>
      </figure>

    </div>
    <script> document.getElementById("chatroom<?= $id ?>").style.display="none"; </script>
    <!-- to display the chat room -->
  <?php } ?>
<?php } ?>
<!-- to displace the group -->

<script>
function show_info(id){
  if(document.getElementById("join"+id).style.display=="block"){
    document.getElementById("join"+id).style.display="none";
    document.getElementById('move_up'+id).className ='move_down_fast'; // do down
    document.getElementById('show_info'+id).style.backgroundColor ='#516cff';
    document.getElementById('show_join'+id).style.backgroundColor ='#374aae';
    reset_position(id);
    setTimeout(function() {show_info(id);}, 500)
  } // to handle the case when submit button is pressed
  else if(document.getElementById("info"+id).style.display=="none")
  {
    document.getElementById('show_info'+id).style.backgroundColor ='#516cff';
    document.getElementById('move_up'+id).className ='move_up';
    setTimeout(function() {show_info_detail(id);}, 1000);
    setTimeout(function() {set_position(id);}, 1000);
  } // to handle the case when nth is pressed
  else{
    document.getElementById('move_up'+id).style.marginTop = "0px";
    document.getElementById('show_info'+id).style.backgroundColor ='#374aae';
    document.getElementById('move_up'+id).className ='move_down';
    document.getElementById("info"+id).style.display="none";
    document.getElementById("chatroom"+id).style.display="none";
    setTimeout(function() {reset(id);}, 1000);
  } // to handle the case when more info button is pressed
} // to handle the animation when more info button is clicked
function close_info(id){
  if(document.getElementById("info"+id).style.display=="block")
  {
    document.getElementById('move_up'+id).style.marginTop = "0px";
    document.getElementById('show_info'+id).style.backgroundColor ='#374aae';
    document.getElementById('move_up'+id).className ='move_down';
    document.getElementById("info"+id).style.display="none";
    document.getElementById("chatroom"+id).style.display="none";
    setTimeout(function() {reset(id);}, 1000);
  }
}
function show_info_detail(id){
  document.getElementById("info"+id).style.display="block";
}
function reset(id){
  document.getElementById('move_up'+id).className ='';
}
function set_position(id){
  document.getElementById('move_up'+id).className ='';
  document.getElementById('move_up'+id).style.marginTop = "-200px";
}
function reset_position(id){
  document.getElementById('move_up'+id).style.marginTop = "0px";
}
// to set for the animation for the group card info

function show_join(id){
  if(document.getElementById("info"+id).style.display=="block"){
    document.getElementById("info"+id).style.display="none";
    document.getElementById('move_up'+id).className ='move_down_fast'; // do down
    document.getElementById('show_info'+id).style.backgroundColor ='#374aae';
    document.getElementById('show_join'+id).style.backgroundColor ='#516cff';
    reset_position(id);
    setTimeout(function() {show_join(id);}, 500);
  } // to handle the case when more info button is pressed
  else if(document.getElementById("join"+id).style.display=="none")
  {
    document.getElementById('show_join'+id).style.backgroundColor ='#516cff';
    document.getElementById('move_up'+id).className ='move_up';
    setTimeout(function() {show_join_detail(id);}, 1000);
    setTimeout(function() {set_position(id);}, 1000);
  }
  else{
    document.getElementById('move_up'+id).style.marginTop = "0px";
    document.getElementById('show_join'+id).style.backgroundColor ='#374aae';
    document.getElementById('move_up'+id).className ='move_down';
    document.getElementById("join"+id).style.display="none";
    setTimeout(function() {reset(id);}, 1000);
  }
}
function close_join(id){
  if(document.getElementById("join"+id).style.display=="block")
  {
    document.getElementById('move_up'+id).style.marginTop = "0px";
    document.getElementById('show_join'+id).style.backgroundColor ='#374aae';
    document.getElementById('move_up'+id).className ='move_down';
    document.getElementById("join"+id).style.display="none";
    setTimeout(function() {reset(id);}, 1000);
  }
}
function show_join_detail(id){
  document.getElementById("join"+id).style.display="block";
}
// to set for the animation for the group card join
function show_chatroom_detail(id){
  document.getElementById("chatroom"+id).style.display="block";
}
function show_chatroom(id){
  if(document.getElementById("info"+id).style.display=="block"){
    show_chatroom_detail(id);
    document.getElementById('card_basic'+id).style.display ='none';
    set_position(id);
  }
  else{
    document.getElementById('show_chatroom'+id).style.backgroundColor ='#516cff';
    document.getElementById('move_up'+id).className ='move_up';
    setTimeout(function() {show_chatroom_detail(id); document.getElementById('card_basic'+id).style.display ='none';}, 1000);
    setTimeout(function() {set_position(id);}, 1000);
  }
} // to set for the animation for the group card chatroom
function show_info_from_chat(id){
  reset(id);
  if(document.getElementById("info"+id).style.display=="none"){ reset_position(id); }
  document.getElementById('show_chatroom'+id).style.backgroundColor ='#374aae';
  document.getElementById('card_basic'+id).style.display ='block';
  document.getElementById("chatroom"+id).style.display="none";
}
</script>
<!-- to handle the animation for all button -->

<style>
#content_info{
  margin: 0 0 15px;
  font-size: 0.9em;
  color:#555;
}
/* to deeal with the line spacing and font size of an area */

span.tag{
  color:#374aae;
  cursor: pointer;
}
/* to deeal with the tag */

span.tag:hover{
  color:#516cff;
}
/* to deeal with the tag when hover */

button:hover{
  background-color: #516cff !important;
}
img.cursor{
  cursor: pointer;
}
a.prev{
  position:absolute;
  left:30;
  top:400;
  color:white;
  text-decoration: none;
  font-size:20px;
  padding: 7px;
  cursor: pointer;
  border-radius: 3px;
  -webkit-transition: background 1s ease-out;
  -moz-transition: background 1s ease-out;
  -o-transition: background 1s ease-out;
  transition: background 1s ease-out;
}
a.prev:hover{
  background: rgba(0, 0, 0, 0.3);
}
a.next{
  position:absolute;
  right:30;
  top:400;
  color:white;
  text-decoration: none;
  font-size:20px;
  padding: 7px;
  cursor: pointer;
  border-radius: 3px;
  -webkit-transition: background 1s ease-out;
  -moz-transition: background 1s ease-out;
  -o-transition: background 1s ease-out;
  transition: background 1s ease-out;
}
a.next:hover{
  background: rgba(0, 0, 0, 0.3);
}
@media only screen and (max-width: 520px) {
  a.prev{
    left:50%;
    margin-left:-170px;
    color: white;
    z-index: 2;
    border-radius: 30px;
    background: rgba(0, 0, 0, 0.3);
  }
  a.next{
    right:50%;
    margin-right:-176px;
    color: white;
    z-index: 2;
    border-radius: 30px;
    background: rgba(0, 0, 0, 0.3);
  }
}
img.card{
  object-fit: cover;
  height:229px;
  width:auto;
}
.move_up {
  -webkit-animation: moving 1s;
  -webkit-animation-fill-mode: forwards;
  animation: moving 1s;
  animation-fill-mode: forwards;
}
.move_down {
  -webkit-animation: downing 1s;
  -webkit-animation-fill-mode: forwards;
  animation: downing 1s;
  animation-fill-mode: forwards;
}
.move_up_fast {
  -webkit-animation: moving 0.5s;
  -webkit-animation-fill-mode: forwards;
  animation: moving 0.5s;
  animation-fill-mode: forwards;
}
.move_down_fast {
  -webkit-animation: downing 0.5s;
  -webkit-animation-fill-mode: forwards;
  animation: downing 0.5s;
  animation-fill-mode: forwards;
}
@keyframes moving {
  from {transform: translateY(0px);}
  to {transform: translateY(-200px);}
}
@keyframes downing {
  from {transform: translateY(-200px);}
  to {transform: translateY(0px);}
}
.snip1336{
  background-color: #E9E9E9;
}
.snip1336 figcaption.curve:before {
  position: absolute;
  content: '';
  bottom: 100%;
  left: 0;
  width: 0;
  height: 0;
  border-style: solid;
  border-width: 0px 0 0 315px;
  border-color: transparent;
}
.snip1336 figcaption.curve{
  padding-top: 0px;
}
textarea.join{
  color:#333;
  line-height:1.4em;
  font-size: 0.9em;
  width:265px;
  height:102px;
  resize:none;
  padding:10px;
  border-radius:0px;
  border-color: #666;
  -webkit-appearance: none; /* to delete inner shadow from safari teatarea */
}
.chatroom_shadow {
  -moz-box-shadow:    inset 0 0 3px #999;
  -webkit-box-shadow: inset 0 0 3px #999;
  box-shadow:         inset 0 0 3px #999;
}
</style>

<?php
function display_group_chat($id,$db_conn){
  $sth_chat = $db_conn->prepare("SELECT * FROM (SELECT * FROM group_chat_".$id." ORDER BY id DESC LIMIT 10) tmp order by tmp.id asc");
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

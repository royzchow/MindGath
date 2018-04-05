<?php session_start(); ?>
<head>
  <title>MindGath | To Gather People with Similar Interest</title>
  <link rel="icon" type="image/png" href="../image/logo_simple.jpg"/>
  <link rel="stylesheet" type="text/css" href="../general/mindgath.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="//malsup.github.com/jquery.form.js"></script>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

</head>

<body style="background-image:url(../image/background<?= rand(1,2) ?>.jpg);min-height:725px;">
  <?php include '../general/menu.php'; $page="my_profile"; ?>
  <?php menu($page); ?>
  <!-- to displace the menu bar after login -->

  <br><br><br>

  <?php
  $id = $_GET['id'];
  $db_conn = new PDO('sqlite:../mindgath.sqlite');
  $sth = $db_conn->prepare("SELECT * FROM user WHERE id='$id'");
  $sth->execute();
  if($row = $sth->fetch(PDO::FETCH_ASSOC)){
    $username = $row['username'];
    $gender = $row['gender'];
    $location = $row['location'];
    $age = $row['age'];
    $description_head = $row['description_head'];
    $description_body = $row['description_body'];
    $tag = $row['tag'];
    $tagSplite = explode(',',$tag);
  }
  ?>

  <style>
  /* The card */
  .card {
    position: relative;
    height: 430px;
    width: 750px;
    margin: 200px 0px 0px 0px;
    background-color: #FFF;
    -webkit-box-shadow: 10px 10px 93px 0px rgba(0, 0, 0, 0.75);
    -moz-box-shadow: 10px 10px 93px 0px rgba(0, 0, 0, 0.75);
    box-shadow: 10px 10px 93px 0px rgba(0, 0, 0, 0.75);
  }

  /* Image on the left side */
  .thumbnail {
    float: left;
    position: relative;
    left: 30px;
    top: -30px;
    height: 250px;
    width: 380px;
    -webkit-box-shadow: 10px 10px 60px 0px rgba(0, 0, 0, 0.75);
    -moz-box-shadow: 10px 10px 60px 0px rgba(0, 0, 0, 0.75);
    box-shadow: 10px 10px 60px 0px rgba(0, 0, 0, 0.75);
    overflow: hidden;
  }

  /*object-fit: cover; */
  /*object-position: center; */
  img.left {
    position: absolute;
    left: 50%;
    top: 50%;
    height: auto;
    width: 100%;
    -webkit-transform: translate(-50%, -50%);
    -ms-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%);
  }

  /* Right side of the card */
  .right {
    margin-left: 440px;
    margin-right: 20px;
  }

  h1 {
    padding-top: 15px;
    font-size: 1.3rem;
    color: #4B4B4B;
  }

  .author {
    background-color: #9ECAFF;
    height: 30px;
    width: 110px;
    border-radius: 20px;
  }

  .author > img {
    padding-top: 5px;
    margin-left: 10px;
    float: left;
    height: 20px;
    width: 20px;
    border-radius: 50%;
  }

  h2 {
    padding-top: 8px;
    margin-right: 6px;
    text-align: right;
    font-size: 0.8rem;
  }

  .separator {
    margin-top: 0px;
    border: 1px solid #C3C3C3;
    width:285px;
  }

  /* DATE of release */
  h5 {
    position: absolute;
    left: 30px;
    font-size: 6rem;
    color: #C3C3C3;
  }

  h6 {
    position: absolute;
    left: 30px;
    font-size: 2rem;
    color: #C3C3C3;
  }

  /* Those futur buttons */
  ul {
    margin-left: 250px;
  }

  li {
    display: inline;
    list-style: none;
    padding-right: 40px;
    color: #7B7B7B;
  }
  textarea{
    border:none;
    display: block;
    color: #555;
    resize:none;
    border-radius:0px;
    -webkit-appearance: none; /* to delete inner shadow from safari teatarea */
  }
  textarea.description{
    border:none;
    display: block;
    color: #555;
    width: 285px;
    resize:none;
    border-radius:0px;
    -webkit-appearance: none; /* to delete inner shadow from safari teatarea */
    height:145px;
    font-size: 14px;
    line-height:1.6em;
  }
  p.intro {
    text-align: left;
    padding-top: 10px;
    font-size: 0.95rem;
    line-height: 150%;
    color: #4B4B4B;
  }
  p.intro textarea {
    text-align: left;
    font-size: 0.95rem;
    line-height: 150%;
    color: #777;
  }
  </style>

  <center>
    <div class="card" style="margin-top:30px;">
      <table>
        <tr valign="top">
          <td>
            <div class="thumbnail"><img class="left" src="http://cdn2.hubspot.net/hubfs/322787/Mychefcom/images/BLOG/Header-Blog/photo-culinaire-pexels.jpg"/></div>
          </td>
          <td rowspan="2">
            <div style="margin-right:20px;">
              <div style="height:30px;"></div>
              <div class="image-cropper" style="height:80px; width:80px; margin-left: auto; margin-right: auto;"><img class="shadow" src="https://thetutor.hk/MindGath/image/user_icon/<?= $id ?>.jpg" onerror="this.src='https://thetutor.hk/MindGath/image/icon.jpg'" style="height:80px;"></img></div>
              <?php if($_SESSION['id']==$_GET['id']) { ?>
                <textarea id="description_head" placeholder="One-line Description" style="text-align:center; height:2.4rem; margin-top:10px; font-size:1.4rem; font-weight:bold; width:285px;"><?= $description_head ?></textarea>
              <?php } else if($description_head=="") { ?>
                <textarea style="text-align:center; height:2.4rem; margin-top:10px; font-size:1.4rem; font-weight:bold; width:285px;" readonly>No Description :(</textarea>
              <?php } else {?>
                <textarea style="text-align:center; height:2.4rem; margin-top:10px; font-size:1.4rem; font-weight:bold; width:285px;" readonly><?= $description_head; ?></textarea>
              <?php } ?>
              <div class="separator"></div>
              <p class="intro">
                <?php if($_SESSION['id']==$_GET['id']) { ?>
                  <textarea class="description" id="description_body" placeholder="It will be your description here. Please write something that you think can impress someone and can let people know you more. The paragraph should not be that long. We will have a limit on the height of the paragraph."><?= $description_body; ?></textarea>
                <?php } else if($description_body=="") { ?>
                  <textarea class="description" readonly>This user didn't leave any description here :(</textarea>
                <?php } else {?>
                  <textarea class="description" readonly><?= $description_body; ?></textarea>
                <?php } ?>
              </p>
            </div>
          </td>
        </tr>
        <tr valign="top">
          <td style="min-width:425px; padding-right:11px;">
            <div style="margin-left:30px;">
              <div style="text-align:left">
                <h4 style="font-size:22px; margin-bottom:5px;">Personal Information:</h4>
                <div style="font-size:12px;">
                  <table>
                    <tr>
                      <td><span style="color:#555; font-size:14px;">Name: </span>
                        <?php if($_SESSION['id']==$_GET['id']){ ?>
                          <textarea id="username" class="detail" placeholder="Nickname"><?= $username; ?></textarea>
                        <?php }else if($username=="") { ?>
                          <textarea class="detail" readonly>N/A</textarea>
                        <?php } else {?>
                          <textarea class="detail" readonly><?= $username; ?></textarea>
                        <?php } ?>
                      </td>
                      <td><span style="color:#555; font-size:14px;">Age: </span>
                        <?php if($_SESSION['id']==$_GET['id']){ ?>
                          <textarea id="age" class="detail" placeholder="xx"><?= $age; ?></textarea>
                        <?php }else if($age=="") { ?>
                          <textarea class="detail" readonly>N/A</textarea>
                        <?php } else {?>
                          <textarea class="detail" readonly><?= $age; ?></textarea>
                        <?php } ?>
                      </td>
                    </tr>
                    <tr>
                      <td><span style="color:#555; font-size:14px;">Gender: </span>
                        <?php if($_SESSION['id']==$_GET['id']){ ?>
                          <textarea id="gender" class="detail" placeholder="Male/Female"><?= $gender; ?></textarea>
                        <?php }else if($gender=="") { ?>
                          <textarea class="detail" readonly>N/A</textarea>
                        <?php } else {?>
                          <textarea class="detail" readonly><?= $gender; ?></textarea>
                        <?php } ?>
                      </td>
                      <td><span style="color:#555; font-size:14px;">Location: </span>
                        <?php if($_SESSION['id']==$_GET['id']){ ?>
                          <textarea id="location" class="detail" placeholder="City, State" style="width:170px;"><?= $location; ?></textarea>
                        <?php }else if($location=="") { ?>
                          <textarea class="detail" readonly>N/A</textarea>
                        <?php } else {?>
                          <textarea class="detail" style="width:170px;" readonly><?= $location; ?></textarea>
                        <?php } ?>
                      </td>
                  </table>
                </div>
              </div>
              <div style="text-align:left; margin-top:15px;">
                <h4 style="font-size:22px; margin-bottom:5px;">Interest/Skill:</h4>
                <?php if($_SESSION['id']==$_GET['id']){ ?>
                  <textarea id="tag" class="detail" style="color:#516cff; width:380px; height:34px;" placeholder="Fill in your interest and skill here"><?php if($tagSplite[0]!="") echo "#".$tagSplite[0]; for($i=1;$i<count($tagSplite);$i++){ echo " #".$tagSplite[$i]; } ?></textarea>
                <?php }else if($tagSplite[0]=="") { ?>
                  <textarea class="detail" style="color:#516cff; width:380px; height:34px;" readonly>N/A</textarea>
                <?php } else {?>
                  <span class="detail" style="color:#516cff; width:380px; height:34px; font-size:14px;" readonly><?php if($tagSplite[0]!="") echo "<span class='tag'>#".$tagSplite[0]."</span>"; for($i=1;$i<count($tagSplite);$i++){ echo " <span class='tag'>#".$tagSplite[$i]."</span>"; } ?></span>
                <?php } ?>
              </div>
            </div>
          </td>
        </tr>
      </table>

    </div>
  </center>
</body>

<div style="color:white; margin-top:0px; font-size:13px; position:fixed; right:0; bottom:7;">
  <div style="height:5px;"></div>
  <div style="float:right; margin-right:20px;">
    <p style="">copyright by MindGath Ltd</p>
  </div>
</div>
<!-- to display the footer -->


<style>
.tag:hover{
  color: #374aae;
}
.tag{
  cursor:pointer;
}
</style>
<style>
textarea.detail{
  margin-bottom: -4px;
  display:inline;
  font-size:14px;
  width:100px;
  height:18px;
  color:#777;
}
</style>

<script>
function change_login(){
  document.getElementById("register").style.display="none";
  document.getElementById("login").style.display="block";
}
function change_register(){
  document.getElementById("register").style.display="block";
  document.getElementById("login").style.display="none";
}

document.addEventListener('mousedown', function (event) {
  if (event.detail > 1) {
    event.preventDefault();
  }
}, false);
// to disallow double click to select text

var change_description_body=0;


function get_input(){
  var input_description_body = $("#description_body").val();
  $("#description_body").text(input_description_body);
  var input_description_head = $("#description_body").val();
  $("#description_body").text(input_description_head);
  var age = $("#age").val();
  $("#age").text(age);
  var gender = $("#gender").val();
  $("#gender").text(gender);
  var location = $("#location").val();
  $("#location").text(location);
  var username = $("#username").val();
  $("#username").text(username);
  var tag = $("#tag").val();
  $("#tag").text(tag);
}
get_input();
// to get all the value from the inputs

$("#description_body").keyup(function(e) {
  get_input();
  str = $("#description_body").val();
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("GET", "update_user.php?id=<?= $id ?>&item=description_body&str="+str, true);
  xmlhttp.send();
});
$("#description_head").keyup(function(e) {
  get_input();
  str = $("#description_head").val();
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("GET", "update_user.php?id=<?= $id ?>&item=description_head&str="+str, true);
  xmlhttp.send();
});
$("#age").keyup(function(e) {
  get_input();
  str = $("#age").val();
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("GET", "update_user.php?id=<?= $id ?>&item=age&str="+str, true);
  xmlhttp.send();
});
$("#gender").keyup(function(e) {
  get_input();
  str = $("#gender").val();
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("GET", "update_user.php?id=<?= $id ?>&item=gender&str="+str, true);
  xmlhttp.send();
});
$("#location").keyup(function(e) {
  get_input();
  str = $("#location").val();
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("GET", "update_user.php?id=<?= $id ?>&item=location&str="+str, true);
  xmlhttp.send();
});
$("#username").keyup(function(e) {
  get_input();
  str = $("#username").val();
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("GET", "update_user.php?id=<?= $id ?>&item=username&str="+str, true);
  xmlhttp.send();
});
$("#tag").keyup(function(e) {
  get_input();
  str = $("#tag").val();
  //while(str[str.length-1]=="#" || str[str.length-1]==" ") str = str.substr(1,str.length-1); // Needa to it later
  str = str.replace(/ #/g,","); // to deal with the "#" sign
  str = str.substr(1); // to delete the first ","
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("GET", "update_user.php?id=<?= $id ?>&item=tag&str="+str, true);
  xmlhttp.send();
});
// to update the information to database

$("#tag").keydown(function(e) {
  get_input();
  str = $("#tag").val();
  if(str.length==0){
    var text = $('#tag');
    text.val(text.val() + '#');
  }
});

$('#tag').focus(function() {
  var text = $('#tag');
  txt = document.getElementById('tag').value;
  if(txt.length==0)
  text.val(text.val() + '#');
});

$("#tag").keypress(function(e){
  var count=0;
  var text = $('#tag');
  txt = document.getElementById('tag').value;
  var c = String.fromCharCode(e.which);
  if(c==" ")
  {
    text.val(text.val() + ' #');
    return false;
  }
});
// to deal with the tag problem
</script>

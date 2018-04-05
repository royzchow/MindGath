<?php session_start(); ?>
<head>
  <title>MindGath | To Gather People with Similar Interest</title>
  <link rel="icon" type="image/png" href="../image/logo_simple.jpg"/>
  <link rel="stylesheet" type="text/css" href="../general/mindgath.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="//malsup.github.com/jquery.form.js"></script>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
  <script type="text/javascript">
  function showPreview(objFileInput) {
    if (objFileInput.files[0]) {
      var fileReader = new FileReader();
      fileReader.onload = function (e) {
        $("#targetLayer").html('<img src="'+e.target.result+'" width="315px" height="100%" class="upload-preview" />');
        $("#targetLayer").css('opacity','1');
        $(".icon-choose-image").css('opacity','1');
      }
      fileReader.readAsDataURL(objFileInput.files[0]);
    }
  }

  $(document).ready(function (e) {
    $("#uploadForm").on('submit',(function(e) {
      e.preventDefault();
      $.ajax({
        url: "upload.php",
        type: "POST",
        data:  new FormData(this),
        beforeSend: function(){$("#body-overlay").show();},
        contentType: false,
        processData:false,
        success: function(data)
        {
          $("#targetLayer").html(data);
          $("#targetLayer").css('opacity','1');
          setInterval(function() {$("#body-overlay").hide(); },500);
        },
        error: function()
        {
        }
      });
    }));
  });
  </script>
  <!-- to handle the image upload -->
</head>

<?php // echo $_SESSION['filename']; ?>




<body onload="onload_hide_step()"style="background-image:url(../image/background<?= rand(1,2) ?>.jpg);min-height:725px;">
    <?php include '../general/menu.php'; $page="create_group"; ?>
    <?php menu($page); ?>
    <!-- to displace the menu bar after login -->

  <br><br><br>

  <center>

  <style>
  .cursor{
    cursor: pointer;
  }

  #upload{
    -webkit-transition: opacity 0.5s ease-out;
    -moz-transition: opacity 0.5s ease-out;
    -o-transition: opacity 0.5s ease-out;
    transition: opacity 0.5s ease-out;
  }
  input.create_group_name{
    margin: 0 0 5px;
    font-weight: 300;
    background-color: #E9E9E9;
    border:none;
    display: block;
    font-size: 25px;
    color: #333;
    width:265px;
    margin-top: -5px;
    margin-bottom:-2px;
  }
  textarea.create_description{
    background-color: #E9E9E9;
    border:none;
    display: block;
    color: #555;
    width:265px;
    resize:none;
    border-radius:0px;
    -webkit-appearance: none; /* to delete inner shadow from safari teatarea */
    height:88px;
    font-size: 14px;
    line-height:1.6em;
  }
  .create_more_info{
    margin: 0 0 5px;
    background-color: #E9E9E9;
    border:none;
    display: block;
    font-size: 1em;
    color: #555;
    display:inline;
    resize:none;
  }

  input.create_member{
    background-color: #E9E9E9;
    border:none;
    display: block;
    color: #374aae;
    display:inline;
    width: 200px;
    margin: 0 0 5px;
    font-weight: 300;
    margin-left: 1px!important;
    font-size: 1em;
    color: #374aae;
    margin: 3px 0 0 0;
  }

  @media only screen and (max-width: 600px) {
    #upload{
      opacity:1!important;
    }
  }

  #step{
    -webkit-transition: opacity 2s ease-out;
    -moz-transition: opacity 2s ease-out;
    -o-transition: opacity 2s ease-out;
    transition: opacity 2s ease-out;
  }


  .realupload {
    position:absolute;
    top:0px;
    right:50%;
    margin-right:-158px;
    opacity:0;
    -moz-opacity:0;
    filter:alpha(opacity:0);
    z-index:2;
    width:315px;
    height:184px;
    background:white;
    cursor: pointer;
  }

  </style>

  <style>
  .bgColor {
    height: 400px;
    border-radius: 4px;
    text-align: center;
  }
  #targetOuter{
    position:relative;
    text-align: center;
    width: 315px;
    height: 250px;
    border-radius: 4px;
  }
  .btnSubmit {
    background-color: #565656;
    border-radius: 4px;
    padding: 10px;
    border: #333 1px solid;
    color: #FFFFFF;
    width: 200px;
    cursor:pointer;
  }
  .inputFile {
    padding: 5px 0px;
    overflow: hidden;
    opacity: 0;
    cursor:pointer;
    width:315px;
    height:250px;
  }


  #body-overlay {background-color: rgba(0, 0, 0, 0.6);z-index: 999;position: absolute;left: 0;top: 0;width: 100%;height: 100%;display: none;}
  #body-overlay div {position:absolute;left:50%;top:50%;margin-top:-32px;margin-left:-32px;}

  </style>
  <!-- to handle the image upload -->

  <?php
  if($_SESSION['filename']=="")
  {
    $link = "https://thetutor.hk/MindGath/image/create_background.jpg";
  }
  else
  {
    $link = "https://thetutor.hk/MindGath/create/uploads/".$_SESSION['filename'];
  }
  ?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!--

  <script>
  $(document).ready(function(){
      $("#submit_btn").click(function(){
          $("#example_info").animate({left: '250px'});
      });
  });
  <style>
  #example_info{
    position:absolute;
  }
  </style>
  // to make the card move left
  </script>
  -->
  </head>

    <table>
      <tr>
        <td>
          <div id="example_info">
            <figure class="snip1336">
              <center><p id="step" style="position:absolute; color:white; top:-30;">Step1: Upload Your Cover</p></center>

              <div class="cursor" onmouseover="show_upload()" onmouseout="hide_upload()">
                <!--<form id="uploadForm" action="upload.php" method="post">-->
                <form id="uploadForm" method="post">
                  <div class="bgColor" style="position:absolute;">
                    <div id="targetOuter">
                      <div id="targetLayer"></div>
                      <div class="icon-choose-image" >
                        <input name="userImage" id="userImage" type="file" class="inputFile" onChange="showPreview(this); to_step2();" />
                      </div>
                    </div>
                    <div>
                    </div>
                  </div>
                  <img  src="https://thetutor.hk/MindGath/image/camera.png" style="width:20px; position:absolute; top:12; left:16;" />
                  <span id="upload" style="font-size:1em; position:absolute; left:45; top:12; color:#CCC; opacity:0;">Upload Cover</span>
                  <img if="cover" class="card" style="opacity:1;" src="<?= $link ?>" alt="sample87" />
                </div>
                </form>
                <figcaption id="move_up">
                  <img src="https://thetutor.hk/MindGath/image/user_icon/<?= $_SESSION['id'] ?>.jpg" alt="profile-sample4" class="profile" />
                  <h2><input name="group_name" id="group_name" class="create_group_name" placeholder="Your Group Name"></input><span>Member: 1/<input name="max_member" id="max_member" class="create_member" placeholder="Type max no. of Member (Max 20)"></input></span></h2>
                  <p id="description" style="min-height:88px;max-height:88px;"><textarea name="description" id="description" class="create_description" placeholder="Type your description here. You can introduce what your group is about and etc. Make sure your description is within 4 lines."></textarea></p>
                  <div id="disappear">
                    <button id="submit_btn" onclick="submit();" class="follow">Create</button>
                    <button id="show_info_button" onclick="show_info()" class="info">More Info</button>
                  </div>
                  <div id="info" style="margin-top:20px; max-height:165px; display:none;">
                    <span style="color:#333;">Status:</span> Active<br><div style="height:5px;"></div>
                    <span style="color:#333;">Leader:</span> Roy Chow<br><div style="height:3px;"></div>
                    <span style="color:#333;">Establish:</span> <?= date("j") ?> <?= date("M") ?> <?= date("Y") ?><br><div style="height:3px;"></div>
                    <span style="color:#333;">Location:</span> <input name="location" id="location" class="create_more_info" placeholder="City, State"></input><br><div style="height:3px;"></div>
                    <!-- <span style="color:#333;">Age Group:</span> <input class="create_more_info" placeholder="XX-XX"></input><br><div style="height:4px;"></div> -->
                    <style>
                    span.tag{
                      color:#374aae;
                      cursor: pointer;
                    }
                    span.tag:hover{
                      color:#516cff;
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
                    </style>
                    <span style="color:#333;">Tags:</span> <input name="tag" id="tag" class="create_more_info" style="width:225px; color:#374aae;" placeholder="Three Most Important Tags"></input>
                    <span style="color:#333;">Requirement:</span> <textarea name="requirement" id="requirement" class="create_more_info" onchange="to_step3();" style="display:inline; width:100%;" placeholder="Any requirment such as the age group and the skill level (optional)"></textarea><br><div style="height:3px;"></div>
                  </div>

                  <div id="join" style="margin-top:20px; max-height:165px; min-height:165px; display:none;">
                    <span style="color:#333;">Message:</span><br><div style="height:8px;"></div>
                    <textarea class="join" placeholder="Type your message here..."></textarea><br><div style="height:15px;"></div>
                    <button style="width:100%; font-size:1em;">Send Request</button>
                  </div>
                </figcaption>
              </figure>
              <!-- <input type="submit" value="Upload Photo" class="btnSubmit" />-->

          </div>
        </td>
      </tr>
    </table>

    <script>
    function submit() {
      group_name = document.getElementById('group_name').value;
      max_member = document.getElementById('max_member').value;
      description = $.trim($("textarea#description").val());
      user_location = document.getElementById('location').value;
      tag = document.getElementById('tag').value;
      requirement = $.trim($("textarea#requirement").val());
      var tagResult = tag.replace(/#/g,'');
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.open("GET", "process.php?group_name="+group_name+"&max_member="+max_member+"&description="+description+"&user_location="+user_location+"&tag="+tagResult+"&requirement="+requirement, true);
      xmlhttp.send();
      window.location.replace("https://thetutor.hk/MindGath/group/index.php?id=1");
    }
    </script>

  </center>
  <!-- to display the group's information -->

</body>


<div style="color:white; margin-top:0px; font-size:13px; position:fixed; right:0; bottom:7;">
  <div style="height:5px;"></div>
  <div style="float:right; margin-right:20px;">
    <p style="">copyright by MindGath Ltd</p>
  </div>
</div>
<!-- to display the footer -->

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

// the start of create
function show_upload(){
  document.getElementById('upload').style.opacity = "1";
}

function hide_upload(){
  document.getElementById('upload').style.opacity = "0";
}


function hide_step(){
  document.getElementById("step").style.opacity="0.2";
}

function onload_hide_step(){
  setTimeout(hide_step, 3000);
}

window.setInterval(function(){
  document.getElementById("step").style.opacity="1";
  setTimeout(hide_step, 3000);
}, 5000);
</script>

<script>

function to_step2() {
  document.getElementById("step").innerHTML="";
  setTimeout(show_info, 1000);
  setTimeout(to_be_step2, 2000);
}
function to_be_step2(){
  document.getElementById("step").style.left="130";
  document.getElementById("step").innerHTML="Step2: Fill in Details";
}
function to_step3() {
  document.getElementById("step").style.left="130";
  document.getElementById("step").innerHTML="Step3: Press Create";
}

function step_right(){
  document.getElementById("step").style.left="130";
  document.getElementById("step").style.display="block";
}

function step_left(){
  document.getElementById("step").style.left="0";
  document.getElementById("step").style.display="block";
}
/* to handle the change of step */

$(document).ready(function(){
    $("#submit_btn").click(function(){
        //window.location.href = "https://thetutor.hk/MindGath/group/";
    });
});
/* to direct page when submit */

$('#tag').focus(function() {
  var text = $('#tag');
  txt = document.getElementById('tag').value;
  if(txt.length==0)
  text.val(text.val() + '#');
});

$("#tag").keydown(function(e) {
  str = $("#tag").val();
  if(str.length==0){
    var text = $('#tag');
    text.val(text.val() + '#');
  }
});

$("#tag").keypress(function(e){
  var count=0;
  var text = $('#tag');
  txt = document.getElementById('tag').value;
  for(i=0;i<txt.length;i++)
  {
    if(txt[i]=="#")
      count++;
  }
  var c = String.fromCharCode(e.which);
  if(c==" ")
  {
    if(count==3) return false;
    text.val(text.val() + ' #');
    return false;
  }
});
// to deal with the tag problem
</script>


<script>
function show_info(){
  if(document.getElementById("info").style.display=="none")
  {
    document.getElementById("step").style.display="none";
    document.getElementById('show_info_button').style.backgroundColor ='#516cff';
    document.getElementById('move_up').className ='move_up';
    setTimeout(function() {show_info_detail();}, 1000);
    setTimeout(function() {set_position();}, 1000);
    setTimeout(function() {step_right();}, 1000);
  } // to handle the case when nth is pressed
  else{
    document.getElementById("step").style.display="none";
    document.getElementById('move_up').style.marginTop = "0px";
    document.getElementById('show_info_button').style.backgroundColor ='#374aae';
    document.getElementById('move_up').className ='move_down';
    document.getElementById("info").style.display="none";
    setTimeout(function() {reset();}, 1000);
    setTimeout(function() {step_left();}, 1000);
  } // to handle the case when more info button is pressed
} // to handle the animation when more info button is clicked
function close_info(){
  if(document.getElementById("info").style.display=="block")
  {
    document.getElementById('move_up').style.marginTop = "0px";
    document.getElementById('show_info_button').style.backgroundColor ='#374aae';
    document.getElementById('move_up').className ='move_down';
    document.getElementById("info").style.display="none";
    setTimeout(function() {reset();}, 1000);
  }
}
function show_info_detail(){
  document.getElementById("info").style.display="block";
}
function reset(){
  document.getElementById('move_up').className ='';
}
function set_position(){
  document.getElementById('move_up').className ='';
  document.getElementById('move_up').style.marginTop = "-200px";
}
function reset_position(){
  document.getElementById('move_up').style.marginTop = "0px";
}
// to set for the animation for the group card info
</script>
<!-- to handle the animation for all button -->

<style>
#info{
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
</style>

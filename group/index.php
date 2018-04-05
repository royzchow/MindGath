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




<body style="background-image:url(../image/background<?= rand(1,2) ?>.jpg);min-height:725px;">
  <?php include '../general/menu.php'; $page="none"; ?>
  <?php menu($page); ?>

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

  @media only screen and (max-width: 1200px) {
    #example_info{
      display:none;
    }
    #content{
      margin-left:-150px!important;
    }
  }
  @media only screen and (max-width: 860px) {
    #advertisement{
      display:none;
    }
    #margin_left{
      display:none;
    }
    #margin_right{
      display:none;
    }
    #content{
      margin-left:-38px!important;
      margin-right:10px!important;
    }
    .resize_input{
      width:100%!important;
    }
  }

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

  <table id="content" style="margin-left:-120px; border:none; border-collapse:collapse;">
    <tr>
      <td style="max-width:315px; vertical-align:top; margin:0px; padding:0px;">

        <?php include '../general/display_group.php'; $db_conn = new PDO('sqlite:../mindgath.sqlite'); $type="group"; ?>
        <?php display_group($_GET['id'],$db_conn,$type); ?>

      </td>
      <td style="min-width:50px; max-width:50px;"></td>
      <!-- ------------------------------------------------------------ -->
      <!-- ------------------------------------------------------------ -->
      <!-- ------------------------------------------------------------ -->
      <!-- the start of event part -->

      <style>
      .container {
        -ms-overflow-style: none;  // IE 10+
        overflow: -moz-scrollbars-none;  // Firefox
      }
      .container::-webkit-scrollbar {
        display: none;  // Safari and Chrome
      }
      </style>

      <td style="max-height:500px;">
        <div style="height:10px;"></div>
        <div class="container" style="width:100%; max-height:500px; overflow-y:scroll;">
          <!-- start of content -->
          <div style="padding:20px; background-color:white; margin-bottom:30px;">
            <table style="margin-bottom:8px;">
              <tr>
                <td>
                  <div id="icon_desktop" class="image-cropper" style="width:50px; height:50px;"><img class="shadow cursor" onclick="show_menu()" src="https://thetutor.hk/MindGath/example/icon1.jpg"></img></div>
                </td>
                <td style="width:10px;"></td>
                <td><div style="height:3px;"></div><span style="color:#374aae;">Roy Chow</span><br><div style="height:3px;"></div><span style="font-size:12px;">20 Feb 2018</span></td>
              </tr>
              <tr>
              </table>
              Hi everyone! Welcome to this page! Hope you all will emjoy the love of the forest!<br>
              It is my first time to create a group. So if I am doing something wrong, please feel free to tell me at anytime!<br>
              <table style="margin-top:15px;">
                <tr>
                  <td>
                    <div id="icon_desktop" class="image-cropper" style="width:30px; height:30px;"><img class="shadow cursor" onclick="show_menu()" src="https://thetutor.hk/MindGath/example/icon2.jpg"></img></div>
                  </td>
                  <td style="width:5px;"></td>
                  <td>
                    <input class="resize_input" style="width:400px; height:30px; padding:10px; background-color:white; border-radius:10px; border-width:1px; font-size:14px;" placeholder="Type your comment & hit Enter..."></input>
                  </td>
                </tr>
              </table>
            </div>
            <div style="padding:20px; background-color:white; margin-bottom:30px;">
              <table style="margin-bottom:8px;">
                <tr>
                  <td>
                    <div id="icon_desktop" class="image-cropper" style="width:50px; height:50px;"><img class="shadow cursor" onclick="show_menu()" src="https://thetutor.hk/MindGath/example/icon2.jpg"></img></div>
                  </td>
                  <td style="width:10px;"></td>
                  <td><div style="height:3px;"></div><span style="color:#374aae;">Kevin</span><br><div style="height:3px;"></div><span style="font-size:12px;">20 Feb 2018</span></td>
                </tr>
                <tr>
                </table>
                It is my first time to create a group. So if I am doing something wrong, please feel free to tell me at anytime!<br>
                <table style="margin-top:15px;">
                  <tr>
                    <td>
                      <div id="icon_desktop" class="image-cropper" style="width:30px; height:30px;"><img class="shadow cursor" onclick="show_menu()" src="https://thetutor.hk/MindGath/example/icon2.jpg"></img></div>
                    </td>
                    <td style="width:5px;"></td>
                    <td>
                      <input class="resize_input" style="width:400px; height:30px; padding:10px; background-color:white; border-radius:10px; border-width:1px; font-size:14px;" placeholder="Type your comment & hit Enter..."></input>
                    </td>
                  </tr>
                </table>
              </div>
              <div style="padding:20px; background-color:white; margin-bottom:30px;">
                <table style="margin-bottom:8px;">
                  <tr>
                    <td>
                      <div id="icon_desktop" class="image-cropper" style="width:50px; height:50px;"><img class="shadow cursor" onclick="show_menu()" src="https://thetutor.hk/MindGath/example/icon3.jpg"></img></div>
                    </td>
                    <td style="width:10px;"></td>
                    <td><div style="height:3px;"></div><span style="color:#374aae;">Jeffery</span><br><div style="height:3px;"></div><span style="font-size:12px;">20 Feb 2018</span></td>
                  </tr>
                  <tr>
                  </table>
                  Hi everyone! Welcome to this page! Hope you all will emjoy the love of the forest!<br>
                  It is my first time to create a group. So if I am doing something wrong, please feel free to tell me at anytime!<br>
                  <table style="margin-top:15px;">
                    <tr>
                      <td>
                        <div id="icon_desktop" class="image-cropper" style="width:30px; height:30px;"><img class="shadow cursor" onclick="show_menu()" src="https://thetutor.hk/MindGath/example/icon2.jpg"></img></div>
                      </td>
                      <td style="width:5px;"></td>
                      <td>
                        <input class="resize_input" style="width:400px; height:30px; padding:10px; background-color:white; border-radius:10px; border-width:1px; font-size:14px;" placeholder="Type your comment & hit Enter..."></input>
                      </td>
                    </tr>
                  </table>
                </div>
                <div style="padding:20px; background-color:white; margin-bottom:30px;">
                  <table style="margin-bottom:8px;">
                    <tr>
                      <td>
                        <div id="icon_desktop" class="image-cropper" style="width:50px; height:50px;"><img class="shadow cursor" onclick="show_menu()" src="https://thetutor.hk/MindGath/example/icon1.jpg"></img></div>
                      </td>
                      <td style="width:10px;"></td>
                      <td><div style="height:3px;"></div><span style="color:#374aae;">Roy Chow</span><br><div style="height:3px;"></div><span style="font-size:12px;">20 Feb 2018</span></td>
                    </tr>
                    <tr>
                    </table>
                    Hi everyone! Welcome to this page! Hope you all will emjoy the love of the forest!<br>
                    It is my first time to create a group. So if I am doing something wrong, please feel free to tell me at anytime!<br>
                    <table style="margin-top:15px;">
                      <tr>
                        <td>
                          <div id="icon_desktop" class="image-cropper" style="width:30px; height:30px;"><img class="shadow cursor" onclick="show_menu()" src="https://thetutor.hk/MindGath/example/icon2.jpg"></img></div>
                        </td>
                        <td style="width:5px;"></td>
                        <td>
                          <input class="resize_input" style="width:400px; height:30px; padding:10px; background-color:white; border-radius:10px; border-width:1px; font-size:14px;" placeholder="Type your comment & hit Enter..."></input>
                        </td>
                      </tr>
                    </table>
                  </div>
                </div>
              </td>
              <td id="margin_left" style="min-width:50px;"></td>
              <td id="advertisement" style="max-width:30px; vertical-align:top;">
                <div style="height:10px;"></div>
                <div style="width:220px; max-height:500px; background-color:white;">
                  <img src="https://thetutor.hk/MindGath/example/advertisment1.jpg" style="width:220px;"></img>
                </div>
              </td>
              <td id="margin_right" style="min-width:80px;"></td>
            </tr>
          </table>


          <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

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

      $(window).click(function() {
        for(i=2;i<5;i++){document.getElementById("menu_btn"+i).style.pointerEvents = "none";}
        document.getElementById("menu").style.opacity="0";
      });
      $('#menu').click(function(event){
        event.stopPropagation();
      });
      $('#icon_desktop').click(function(event){
        event.stopPropagation();
      });
      $('#icon_mobile').click(function(event){
        event.stopPropagation();
      });
      // to hide the menu when clicking body

      function plus_slides(){
        if(document.getElementById("2").style.display=="none")
        {
          document.getElementById("1").style.display="none";
          document.getElementById("2").style.display="block";
        } else {
          document.getElementById("1").style.display="block";
          document.getElementById("2").style.display="none";
        }
      }
      // example for swap pages

      document.addEventListener('mousedown', function (event) {
        if (event.detail > 1) {
          event.preventDefault();
        }
      }, false);
      // to disallow double click to select text
      </script>

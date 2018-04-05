<?php session_start(); ?>
<head>
  <title>MindGath | To Gather People with Similar Interest</title>
  <link rel="icon" type="image/png" href="./image/logo_simple.jpg"/>
  <link rel="stylesheet" type="text/css" href="./general/mindgath.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</head>

<script>
function login(item) {
  email_menu=document.getElementById('email_menu').value;
  password_menu=document.getElementById('password_menu').value;
  email_box=document.getElementById('email_box').value;
  password_box=document.getElementById('password_box').value;
  if(item=="box"){
    email_menu=email_box;
    password_menu=password_box;
  }
  // to get the value from the input form

  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      if(this.responseText=="success"){
        window.location = "./";
      }else{
        alert("login failed");
      }
    }
  }
  xmlhttp.open("GET", "./general/login.php?email="+email_menu+"&password="+password_menu, true);
  xmlhttp.send();
}
</script>

<?php if($_SESSION["login"]==0){ ?>

  <body style="background-image:url(./image/background<?= rand(1,2) ?>.jpg);min-height:725px;">
    <img id="header" src="./image/logo.png" style="height:70px; margin-top:30px; margin-left:150px;"></img>
    <div id="header" style="float:right; margin-top:50px; margin-right:120px;">
      <!--<form action="./general/login.php" method="post">-->
        <table>
          <tr>
            <td><input id="email_menu" class="shadow" name="email" placeholder="Email" type="email" style="border:none; padding:10px; height:32px; width:200px; margin-right:10px;"></input></td>
            <td><input id="password_menu" class="shadow" name="password" placeholder="Password" type="password" style="border:none; padding:10px; height:32px; width:200px; margin-right:10px;"></input></td>
            <td><button onclick="login('menu'); return false;" class="shadow" type="submit" style="border:none; padding:5px; height:32px; width:80px; background-color:#374aae; color:white; font-size:14px;">Login</button></td>
          </tr>
        </table>
      <!--</form>-->
    </div>
    <center>
      <img id="logo" src="./image/logo.png" style="height:90px; margin-bottom:-50px; margin-top:50px;"></img>
    </center>
    <!-- to display the header with login function -->
    <div id="register" class="container">
      <form id="contact" action="./general/register.php" method="post">
        <h3>Register Now</h3>
        <h4>To gather people with similar interest</h4>
        <fieldset>
          <input placeholder="Your Name" type="text" name="username" required autofocus>
        </fieldset>
        <fieldset>
          <input placeholder="Your Email Address" type="email" name="email" required>
        </fieldset>
        <fieldset>
          <input placeholder="Your Password" type="password" name="password" required>
        </fieldset>
        <fieldset>
          <input placeholder="Your Password (repeat)" type="password" required>
        </fieldset>
        <fieldset>
          <input placeholder="Your Phone Number (optional)" name="tel" type="tel">
        </fieldset>
        <fieldset>
          <p style="margin-left:3px; margin-top:-5px;">Already have an account? <a href="javascript:" onclick="change_login()" style="color:inherit">Sign in</a> now!</a></p>
        </fieldset>
        <fieldset>
          <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Sign Me Up!</button>
        </fieldset>
      </form>
    </div>
    <!-- to display the registration form -->
    <div id="login" class="container" style="display:none;">
      <form id="contact">
        <h3>Login Now</h3>
        <h4>To gather people with similar interest</h4>
        <fieldset>
          <input id="email_box" placeholder="Email" type="email" name="email" required autofocus>
        </fieldset>
        <fieldset>
          <input id="password_box" placeholder="Password" type="password" name="password" required>
        </fieldset>
        <fieldset>
          <p style="margin-left:3px; margin-top:-5px;">Still don't have an account? <a href="javascript:" onclick="change_register()" style="color:inherit">Register</a> now!</a></p>
        </fieldset>
        <fieldset>
          <button onclick="login('box')" name="submit" type="submit" id="contact-submit" data-submit="...Sending">Login</button>
        </fieldset>
      </form>
    </div>
    <!-- to display the login form -->
  </body>

<?php }else{ ?>

<body style="background-image:url(./image/background<?= rand(1,2) ?>.jpg);min-height:725px;">
<!-- to display the background -->

  <?php include './general/menu.php'; $page="home"; ?>
  <?php menu($page); ?>
  <!-- to displace the menu bar after login -->

  <br><br><br>

  <div>
    <a class="prev" onclick="plus_slides()">&#10094;</a>
    <a class="next" onclick="plus_slides()">&#10095;</a>
  </div>
  <!-- to display the function previous and next page -->

  <center>

    <div id="1" style="display:none;">
      <table>
        <tr>
          <td>

            <figure class="snip1336">
              <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/331810/sample87.jpg" alt="sample87" />
              <figcaption>
                <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/331810/profile-sample4.jpg" alt="profile-sample4" class="profile" />
                <h2>Hiking Club in UCI<span>Member: 12/15</span></h2>
                <p style="min-height:88px;max-height:114px;">I'm looking for something that can deliver a 50-pound payload of snow on a small feminine target. Can you suggest something? Hello...? </p>
                <button onclick="hi()" class="follow">Join</button>
                <button onclick="show_info()" href="#" class="info">More Info</button>
              </figcaption>
            </figure>

          </td>
          <td class="none800px" style="width:30px;"></td>
          <td class="none800px">
            <figure class="snip1336 hover"><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/331810/sample74.jpg" alt="sample74" />
              <figcaption>
                <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/331810/profile-sample2.jpg" alt="profile-sample2" class="profile" />
                <h2>Swimming Club in UCI<span>Member: 19/20</span></h2>
                <p style="min-height:88px;max-height:114px;">Calvin: I'm a genius, but I'm a misunderstood genius. Hobbes: What's misunderstood about you? Calvin: Nobody thinks I'm a genius.</p>
                <button href="#" class="follow">Join</button>
                <button href="#" class="info">More Info</button>
              </figcaption>
            </figure>
          </td>
          <td class="none1200px" style="width:30px;"></td>
          <td class="none1200px">
            <figure class="snip1336"><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/331810/sample69.jpg" alt="sample69" />
              <figcaption>
                <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/331810/profile-sample5.jpg" alt="profile-sample5" class="profile" />
                <h2>Beach Interest Group<span>Member: 2/15</span></h2>
                <p style="min-height:88px;max-height:114px;">If you want to stay dad you've got to polish your image. I think the image we need to create for you is "repentant but learning". Find me...</p>
                <button href="#" class="follow">Join</button>
                <button href="#" class="info">More Info</button>
              </figcaption>
            </figure>
          </td>
        </tr>
      </table>
    </div>

    <?php include './general/display_group.php'; $db_conn = new PDO('sqlite:./mindgath.sqlite'); $id[0]=49; $id[1]=50; $id[2]=51; $type="home_page"; ?>
    <div id="2">
      <table>
        <tr>
          <td> <?php display_group($id[0],$db_conn,$type); ?> </td>
          <!-- to display the first group -->
          <td class="none800px" style="width:30px;"></td>
          <td class="none800px"> <?php display_group($id[1],$db_conn,$type); ?> </td>
          <!-- to display the second group, will not display when width smaller than 800px -->
          <td class="none1200px" style="width:30px;"></td>
          <td class="none1200px"> <?php display_group($id[2],$db_conn,$type); ?> </td>
          <!-- to display the third group, will not display when width smaller than 1200px -->
        </tr>
      </table>
    </div>
    <!-- to display the group for each page -->




  </center>
  <!-- to display the group's information -->

</body>
<?php } ?>

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

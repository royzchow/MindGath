<?php
session_start(); // to get the session login id
function menu($page){ ?>
  <a href="https://thetutor.hk/MindGath/"><img id="header" src="https://thetutor.hk/MindGath/image/logo.png" style="height:70px; margin-top:30px; margin-left:150px;"></img></a>
  <!-- to display the firm logo on left up corner -->
  <div id="header" style="float:right; margin-top:35px; margin-right:120px;">
    <table>
      <tr>
        <td><input class="shadow" onclick="close_info(); close_join();" placeholder="Type your search & hit Enter..." style="border:none; padding:10px; height:32px; width:300px;"></input></td>
        <td style="width:30px;"></td>
        <td><div id="icon_desktop" class="image-cropper"><img class="shadow cursor" onclick="show_menu()" src="https://thetutor.hk/MindGath/image/user_icon/<?= $_SESSION['id'] ?>.jpg" onerror="this.src='https://thetutor.hk/MindGath/image/icon.jpg'" style="cursor: pointer;"></img></div></td>
      </tr>
    </table>
  </div>
  <!-- to display the menu icon button -->
  <div id="menu" class="menu shadow desktop_only" style="max-width:180px; opacity:0; z-index:-1;">
    <center>
      <table style="color:#333; max-width:130px; display:inline-block;">
        <tr><td style="height:20px;"></td></tr>
        <tr>
          <td>
            <div class="image-cropper" style="height:70px; width:70px; margin-left:25px;"><img class="shadow" src="https://thetutor.hk/MindGath/image/user_icon/<?= $_SESSION['id'] ?>.jpg" onerror="this.src='https://thetutor.hk/MindGath/image/icon.jpg'" style="height:70px;"></img></div>
          </td>
        </tr>
        <tr><td style="height:10px; width:120px;"></td></tr>
        <tr>
          <td><div style="background-color:lightgrey; height:1px;"></div></td>
        </tr>
        <tr><td style="height:15px;"></td></tr>
        <tr><td colspan="3"><a id="home" class="menu_btn" style="pointer-events:none;" href="https://thetutor.hk/MindGath/">Home</a></td></tr>
        <tr><td style="height:5px;"></td></tr>
        <tr><td colspan="3"><a id="my_profile" class="menu_btn" style="pointer-events:none;" href="https://thetutor.hk/MindGath/profile/index.php?id=<?= $_SESSION['id'] ?>">My Profile</a></td></tr>
        <tr><td style="height:5px;"></td></tr>
        <tr><td colspan="3"><a id="create_group" class="menu_btn" style="pointer-events:none;" href="https://thetutor.hk/MindGath/create/">Create Group</a></td></tr>
        <tr><td style="height:5px;"></td></tr>
        <tr><td colspan="3"><a id="logout" class="menu_btn" style="pointer-events:none;" href="https://thetutor.hk/MindGath/general/logout.php">Logout</a></td></tr>
        <tr><td style="height:20px;"></td></tr>
      </table>
    </center>
  </div>
  <!-- to deal with the menu popup -->
  <div id="logo" style="margin-top:30px; margin-bottom:-50px;">
  <center>
    <table>
      <tr>
        <td>
          <img src="https://thetutor.hk/MindGath/image/logo.png" style="height:70px; margin-left:-10px;"></img>
        </td>
        <td class="search_margin"></td>
        <td rowspan="2"><div id="icon_mobile" class="image-cropper" onclick="show_menu()" style="height:70px; width:70px; margin-top:25px;"><img class="shadow cursor" src="https://thetutor.hk/MindGath/image/user_icon/<?= $_SESSION['id'] ?>.jpg" style="cursor: pointer;"></img></div></td>
      </tr>
      <tr>
        <td>
          <input class="shadow search_width" onclick="close_info(); close_join();" placeholder="Type your search & hit Enter..." style="border:none; padding:10px; height:32px; margin-top:-7px;"></input>
        </td>
      </tr>
    </table>
  </center>
</div>
  <script>
  document.getElementById("<?= $page ?>").style.color="#374aae";
  // to set the color of menu btn of current page be #374aae
  document.getElementById("<?= $page ?>").class="no_change";
  // to disallow the hover effect for menu btn of current page
  document.getElementById("<?= $page ?>").href="#";
  // to disallow the href of the current page
  document.getElementById("<?= $page ?>").style.cursor="default";
  </script>

  <script>
  function show_menu(){
    if(document.getElementById("menu").style.opacity=="0")
    {
      document.getElementById("menu").style.zIndex="2";
      var all = document.getElementsByClassName("menu_btn");
      for (var i = 0; i < all.length; i++) {
        all[i].style.pointerEvents = "auto";
      }
      document.getElementById("menu").style.opacity="1";
    }
    else if(document.getElementById("menu").style.opacity=="1")
    {
      var all = document.getElementsByClassName("menu_btn");
      for (var i = 0; i < all.length; i++) {
        all[i].style.pointerEvents = "none";
      }
      document.getElementById("menu").style.opacity="0";
      // document.getElementById("menu").style.zIndex="-1";
    }
  }

  $(window).click(function() {
    document.getElementById("menu").style.pointerEvents = "none";
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
  </script>

  <style>

  #menu{
    font-family: "Roboto", Helvetica, Arial, sans-serif;
    font-weight: 100;
    -webkit-transition: opacity 0.4s ease-out;
    -moz-transition: opacity 0.4s ease-out;
    transition: opacity 0.4s ease-out;
  }
  #menu a{
    text-decoration: none;
    color: inherit;
  }
  #menu a:hover{
    color: #516cff;
  }
  #menu a.no_change:hover{
    color:#374aae;
  }
  div.menu{
    position:absolute;
    right:120;
    top:120;
    width:180px;
    background-color: white;
    border-radius: 10px;
    z-index: 2;
  }
  .image-cropper {
    width: 60px;
    height: 60px;
    position: relative;
    overflow: hidden;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    -ms-border-radius: 50%;
    -o-border-radius: 50%;
    border-radius: 50%;
    /* border: 3px solid white; */
  }
  .image-cropper img {
    display: inline;
    margin: 0 auto;
    height: 100%;
    width: auto;
  }
  @media only screen and (max-width: 1200px) {
  .none1200px{
    display:none;
  }
  .search_margin{
    width:265px;
  }
  .search_width{
    width:300px;
  }
  div.menu{
    top:150;
    left:50%;
    margin-left: 145px;
  }
}
@media only screen and (max-width: 860px) {
  .none800px{
    display:none;
  }
  .search_margin{
    width:20px;
  }
  .search_width{
    width:200px;
  }
  div.menu{
    top:150;
    left:50%;
    margin-left: -30px;
  }
}
</style>
<?php } ?>

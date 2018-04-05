
function change_login(){
  document.getElementById("register").style.display="none";
  document.getElementById("login").style.display="block";
}
function change_register(){
  document.getElementById("register").style.display="block";
  document.getElementById("login").style.display="none";
}

function show_menu(){
  if(document.getElementById("menu").style.opacity=="0")
  {
    for(i=2;i<5;i++){document.getElementById("menu_btn"+i).style.pointerEvents = "auto";}
    document.getElementById("menu").style.opacity="1";
  }
  else if(document.getElementById("menu").style.opacity=="1")
  {
    for(i=2;i<5;i++){document.getElementById("menu_btn"+i).style.pointerEvents = "none";}
    document.getElementById("menu").style.opacity="0";
  }
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

function show_info(){
  if(document.getElementById("join").style.display=="block"){
    document.getElementById("join").style.display="none";
    document.getElementById('move_up').className ='move_down_fast'; // do down
    document.getElementById('show_info').style.backgroundColor ='#516cff';
    document.getElementById('show_join').style.backgroundColor ='#374aae';
    reset_position();
    setTimeout(show_info, 500);
  } // to handle the case when submit button is pressed
  else if(document.getElementById("info").style.display=="none")
  {
    document.getElementById('show_info').style.backgroundColor ='#516cff';
    document.getElementById('move_up').className ='move_up';
    setTimeout(show_info_detail, 1000);
    setTimeout(set_position, 1000)
  }
  else{
    document.getElementById('move_up').style.marginTop = "0px";
    document.getElementById('show_info').style.backgroundColor ='#374aae';
    document.getElementById('move_up').className ='move_down';
    document.getElementById("info").style.display="none";
    setTimeout(reset, 1000)
  }
}
function close_info(){
  if(document.getElementById("info").style.display=="block")
  {
    document.getElementById('move_up').style.marginTop = "0px";
    document.getElementById('show_info').style.backgroundColor ='#374aae';
    document.getElementById('move_up').className ='move_down';
    document.getElementById("info").style.display="none";
    setTimeout(reset, 1000)
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

function show_join(){
  if(document.getElementById("info").style.display=="block"){
    document.getElementById("info").style.display="none";
    document.getElementById('move_up').className ='move_down_fast'; // do down
    document.getElementById('show_info').style.backgroundColor ='#374aae';
    document.getElementById('show_join').style.backgroundColor ='#516cff';
    reset_position();
    setTimeout(show_join, 500);
  } // to handle the case when more info button is pressed
  else if(document.getElementById("join").style.display=="none")
  {
    document.getElementById('show_join').style.backgroundColor ='#516cff';
    document.getElementById('move_up').className ='move_up';
    setTimeout(show_join_detail, 1000);
    setTimeout(set_position, 1000)
  }
  else{
    document.getElementById('move_up').style.marginTop = "0px";
    document.getElementById('show_join').style.backgroundColor ='#374aae';
    document.getElementById('move_up').className ='move_down';
    document.getElementById("join").style.display="none";
    setTimeout(reset, 1000)
  }
}
function close_join(){
  if(document.getElementById("join").style.display=="block")
  {
    document.getElementById('move_up').style.marginTop = "0px";
    document.getElementById('show_join').style.backgroundColor ='#374aae';
    document.getElementById('move_up').className ='move_down';
    document.getElementById("join").style.display="none";
    setTimeout(reset, 1000)
  }
}
function show_join_detail(){
  document.getElementById("join").style.display="block";
}
// to set for the animation for the group card join

//ce truc est awesome :3

//////////////////////
// DOM MANIPULATION //
//////////////////////

function redirect(url){
  window.location.replace(url); 
}
function menuslide() {
    var top = $("#float_menu").css("top");
    if (top == "-115px") {
      $("#float_menu").css("top", "25px");
    }else{
      $("#float_menu").css("top", "-115px");
    }
}


function downslide() {
    var curheight = $(this).parents().eq(2).height();
    var height = $(this).parents().eq(1).height()+"px";
    if (curheight == 0) {
      $(this).parents().eq(2).css("height", height);
    }else{
      $(this).parents().eq(2).css("height", 0);
    }
}


function black_on() {
  $("#black").css("display", "block");
}

function black_off() {
  $("#black").css("display", "none");
}

function confirmation() {
 var answer = confirm("Sûr sûr ?");
 if (answer){
        return true;
    }
 return false;  
}

function tr_link (){
  window.location=$(this).find("a").attr("href");
  return false;
}

$(document).ready(function(){
  //$("#float_menu").css("top", "-75px");
  $("#lastrelease").css("height", $("#lastrelease").children().height()+"px");
  $("#bug_title").css("width", 580 - $("#bugoption").width());
  $("#userbar_right").click(menuslide);
  $("#lostpassword").click(black_on);
  $("#closebox").click(black_off);
  $(".version span").click(downslide);
  $("#message").delay(2000).fadeOut(2000);
  $(".confirm").click(confirmation);
  $(".tr_link").click(tr_link);

})


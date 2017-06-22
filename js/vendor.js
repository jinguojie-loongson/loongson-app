$(document).ready(function(){
  $(".dropdown").hide();

  $("#vendor-name").mouseover(function(){
    $(".dropdown").slideDown(100);
  });
  $("#vendor-menu").mouseleave(function(){
    $(".dropdown").slideUp(100);
  });
});


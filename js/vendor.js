$(document).ready(function(){
  $("#vendor-name").mouseover(function(){
    $(".dropdown").slideDown(100);
  });

  $(document).click(function() {
    $(".dropdown").slideUp(100);
  });
});


function goto_category(c)
{
  window.location.href = "category.php?category=" + c;
}


/* JQuery写法 */
var current_category = UrlGetQueryString("category");
console.log(current_category);

$(".category-menu div").each(function() {
  if ($(this).attr("id") == current_category)
  {
    //$(this).addClass("category-focus");
    $(this).css("background-color", "rgb(206, 41, 47)");
  }
});

function deleteCategory(category_id,isActive) {
  url = window.location.href;
  n = url.lastIndexOf("/");
  url = url.substr(0, n) + "/deleteCategory.php?" + "category_id=" + category_id;
  
  console.log(url);
  /*
   *判断当前记录是否可以删除
   */
  if (isActive > 0)
    return;

  /*   
   * 修改状态，返回html
   */
  get_server_service(url, "", function(data) {
    $("#"+category_id).closest("tr").remove();
  });
}

  /*
   *类别添加输入框按钮提示
   */
function category_input_message(){
    $('#addCategory').attr("disabled",true);   
    $("#category_message").text('输入内容不可为空！');
    setTimeout(
       '$("#addCategory").attr("disabled",false);'
       +'$("#category_message").text("")',
       2000
	);
}


$(document).ready(function() {
 
  $("#category_list").on("click","button", function(){
    var category_id = $(this).attr("id");
 
    deleteCategory(category_id);

  });

  $("#saveCategory").click(function() {
    var category_name = $("#addCategory").val();
   
    if (category_name == ""){
        category_input_message();
    }else{
        url = window.location.href;
        n = url.lastIndexOf("/");
        url = url.substr(0, n) + "/addCategory.php?" + "category_name=" + category_name;

    get_server_service(url, "", function(data) {
      $("#category_list").append(
          "<tr> \n"
        + " <td>" + data + "</td> \n"
        + " <td>" + category_name + "</td> \n"
        + " <td id='tdbutton' >"
        + " <button type='button'id="+data+" name ='false' class='btn btn-primary '>删 除</button>"
        + " </td> \n"
        + "</tr> \n"
       );

       $("#addCategory").val("");
     });
    } 
  });
})

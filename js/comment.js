function reset_comment_input()
{
      	$(".app-comment-input").empty();
        $(".app-comment-submit").hide();
}

function submit_comment()
{
	var id = $("#app_id").val();
       	var comment = $(".app-comment-input").text();
	var len = comment.length;

	if (len == 0) {
               	warning_message("评论内容不能为空！");
       	} else if (len > 500) {
               	warning_message("评论内容不能超过500字！");
       	} else {
              	url = window.location.href;
               	n = url.lastIndexOf("/");
               	url = url.substr(0, n) + "/addAppComment.php?" + "id=" + id + "&comment=" + encodeURI(comment);

               	console.log(url);
               	/*
               	 * 提交评论，返回提交内容html
               	 */
               	get_server_service(url, "", function(data) {
               	        $(".app-comment-list").prepend(data);
               	        reset_comment_input();
		        success_message("评论提交成功！");
               	});
       	}
}

$(document).ready(function(){
	$(".app-comment-submit").hide();

	/*
	 * 文本框键盘输入事件
	 */
	$(".app-comment-div").keyup(function() {
        	var len = $(".app-comment-input").text().length;
		if (len > 0) {
			$(".app-comment-submit").show();
		} else {
			$(".app-comment-submit").hide();
		}
	});

	$(".app-comment-submit").click(submit_comment);
});


function audit_yes($btn, $id, audit)
{
  console.log("no: " + $id);
  url = "auditComment.php?id=" + $id + "&audit=" + (1 - audit);
console.log(url);

  get_server_service(url, "", function() {
    if (audit == "1")
    {
      $btn.parent().find("#comment_audit").val("0");
      $btn.html("<div class='glyphicon glyphicon-eye-open'></div> " + "显 示");
    }
    else
    {
      $btn.parent().find("#comment_audit").val("1");
      $btn.html("<div class='glyphicon glyphicon-eye-open'></div> " + "隐 藏");
    }
  });
}

function audit_del($btn, $id)
{
  console.log("no: " + $id);
  url = "auditComment.php?id=" + $id + "&audit=del";
console.log(url);

  get_server_service(url, "", function() {
    $btn.closest("tr").remove();
  });
}

$(document).ready(function(){
  console.log($(".Audit_yes").length);
  $(".Audit_yes").click(function() {
    audit_yes($(this), $(this).parent().find("#comment_id").val(),
                       $(this).parent().find("#comment_audit").val());
  });

  $(".Audit_del").click(function() {
    audit_del($(this), $(this).parent().find("#comment_id").val());
  });
});

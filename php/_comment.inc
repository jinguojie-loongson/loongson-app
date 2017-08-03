<?php

include_once('_db.inc');
include_once('_util.inc');

function insert_app_comment($app_id, $comment)
{
global $conn;
  $comment = addslashes($comment);
  $ip = get_browser_ip();
  $sql = "insert into comment (app_id, comment, date_time, ip, audit) "
       . " values (${app_id}, '${comment}', now(), '${ip}', 1)";
db_exec($sql);
}

function get_app_newest_comment($app_id)
{
global $conn;

  $sql = "select id from comment "
       . "   where app_id=${app_id} and audit=1 "
       . "   order by date_time desc"
       . "   limit 1 ";
  return db_get_one_value($sql);
}

/*
 * 根据 app_id 查询该应用所有的评论id
 */
function get_app_all_comment_id($app_id)
{
global $conn;

  $sql = "select id from comment "
       . "   where app_id=${app_id} and audit=1 "
       . "   order by date_time desc";
  return db_get_one_column($sql);
}

/*
 * 根据 评论id 查询出 应用ID
 */

function get_app_id_by_comment_id($comment_id)
{
global $conn;

  $sql = "select app_id from comment "
         . "  where id=${comment_id}";
  return db_get_one_value($sql);
}

/*
 * 根据 评论id 查询出 评论内容
 */

function get_app_comment($comment_id)
{
global $conn;

  $sql = "select comment from comment "
         . "  where id=${comment_id}";
  return db_get_one_value($sql);
}

/*
 * 根据 评论id 查询出评论时间
 */
function get_app_comment_date_time($comment_id)
{
global $conn;

  $sql = "select DATE_FORMAT(date_time,'%Y-%m-%d %H:%i') from comment "
         . "  where id=${comment_id}";
  return db_get_one_value($sql);
}


/*
 * 根据 评论id 查询出 审核状态
 */
function get_app_comment_audit($comment_id)
{
global $conn;

  $sql = "select audit from comment "
         . "  where id=${comment_id}";
  return db_get_one_value($sql);
}

/*
 * 查询所有的评论id
 */
function get_all_comment_id()
{
global $conn;

  $sql = "select id from comment "
       . "   order by date_time desc";
  return db_get_one_column($sql);
}

function audit_comment($id, $audit)
{
global $conn;

  $sql = "update comment "
       . "   set audit=$audit "
       . "   where id=$id ";
  return db_exec($sql);
}

function audit_comment_del($id)
{
global $conn;

  $sql = "delete from comment "
       . "   where id=$id ";
  return db_exec($sql);
}

/*
 * 组装单个html
 */
function get_app_one_comment_html($id)
{
  $comment =  htmlentities(get_app_comment($i));
  $date_time = get_app_comment_date_time($id);

/*
    <div class="comment">
      <img src='../images/user.png'/>
      <span id="comment_text">${comment}</span>
      <span id="comment_date">${date_time}</span>
    </div>
*/
  $html = "<div class='comment'> \n"
        . "  <img src='../images/user.png'> \n"
        . "  <span id='comment_text'>${comment}</span> \n"
        . "  <span id='comment_date'>${date_time}</span> \n"
       .  "</div> \n";
  return $html;
}

function get_app_all_comment_html($app_id)
{
  $html = "";
  $comment_id = get_app_all_comment_id($app_id);
  if ($comment_id != null && $comment_id != "") {
    foreach ($comment_id as $id)
    {
      $html = $html . get_app_one_comment_html($id);
    }
  } else {
    $html = "<span id='prompt'>还没有任何评论，写点什么吧</span>"; 
  }
  return $html;
}

?>

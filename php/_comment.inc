<?php

include_once('_db.inc');
include_once('_util.inc');

function insert_app_comment($app_id, $comment)
{
global $conn;

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
 * 组装单个html
 */
function get_app_one_comment_html($id)
{
  $comment = get_app_comment($id);
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

  foreach (get_app_all_comment_id($app_id) as $id)
  {
    $html = $html . get_app_one_comment_html($id);
  }
  return $html;
}

?>

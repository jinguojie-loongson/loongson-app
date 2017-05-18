<?php

function db_init()
{
global $conn;
  $mysql_server_name='localhost'; //改成自己的mysql数据库服务器
  $mysql_username='root'; //改成自己的mysql数据库用户名
  $mysql_password=''; //改成自己的mysql数据库密码
  $mysql_database='app'; //改成自己的mysql数据库名

  $conn = mysql_connect($mysql_server_name, $mysql_username, $mysql_password)
        or
        fatal_error("error connecting database");

  mysql_query("set names 'utf8'");
 
  mysql_select_db($mysql_database);
}

function db_get_one_value($sql)
{
global $conn;

  $result = mysql_query($sql, $conn);

  while ($row = mysql_fetch_row($result))
  {
    return $row[0];
  }

  return "";
}

function db_get_one_column($sql)
{
global $conn;

  $result = mysql_query($sql, $conn);

  $a = array();

  while ($row = mysql_fetch_row($result))
  {
    array_push($a, $row[0]);
  }

  return $a;
}

/*
 * 入口
 */
db_init();
?>

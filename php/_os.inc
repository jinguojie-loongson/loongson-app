<?php

include_once('_db.inc');
include_once('_util.inc');
include_once('_app.inc');

function get_os_all_id()
{
global $conn;

  $sql = "select id from os";
  return db_get_one_column($sql);
}

function get_os_name($id)
{
  $sql = "select name from os "
       . " where id = ${id}";
  return db_get_one_value($sql);
}

function get_os_description($id)
{
global $conn;
  $sql = "select description from os "
       . " where id = ${id}";
  return db_get_one_value($sql);
}

function get_os_probe_cmd($id)
{
global $conn;
  $sql = "select probe_cmd from os "
	. " where id = ${id}";
  return db_get_one_value($sql);
}

function get_all_os_with_id()
{
  $sql = "select id, name from os";
  return db_get_two_columns($sql);
}

function get_os_one_html($id)
{
  $name = get_os_name($id);
  $description = get_os_description($id);
  $probe_cmd = get_os_probe_cmd($id);
  $count = get_app_file_os_id_count($id);

  $html_del = "";
  if ($count == 0) {
    $html_del = $html_del . " <button id='del_button' class='btn btn-default'> \n"
	. " <div class='glyphicon glyphicon-trash'></div> 删 除 \n"
	. " </button> \n";
  }
  $html = "<tr> \n"
        . " <td>${id}</td> \n"
        . " <td id='os_name_${id}'>${name}</td> \n"
        . " <td id='os_description_${id}'>${description}</td> \n"
        . " <td id='os_probe_cmd_${id}'>${probe_cmd}</td> \n"
        . " <td> \n"
        . " <input type='hidden' name='os_id' value='${id}'> \n"
        . " <input type='hidden' name='os_name' value='${name}'> \n"
        . " <button id='edi_button' class='btn btn-default' data-toggle='modal' data-target='#myModal'> \n"
        . " <i class='fa fa-pencil'></i> 编辑 \n"
        . " </button> \n"
        . $html_del
        . " </td> \n"
        . " </tr> \n";
  return $html;
}

function get_os_list()
{
  $html = "";
  foreach (get_os_all_id() as $os_id)
  {
    $html = $html . get_os_one_html($os_id);
  }
  return $html;
}

/*
 * 校验系统名称是否重复
 */
function check_os_name($name)
{
global $conn;
  $name = addslashes($name);
  $sql = "select count(1) from os "
	. " where name = '${name}'";
  return db_get_one_value($sql);
}

/*
 * 编辑是判断系统名称是否重复
 */
function update_check_os_name($os_id, $name)
{
global $conn;
  $name = addslashes($name);
  $sql = "select count(1) from os "
	. " where id <> ${os_id} and name = '${name}'";
  return db_get_one_value($sql);
}

/*
 * os 表插入数据
 */
function insert_os($name, $description, $probe_cmd)
{
global $conn;
  $sql = "insert into os (name, description, probe_cmd) "
	. " values ('${name}', '$description', '$probe_cmd')";
  db_exec($sql);
  return mysql_insert_id();
}

/*
 * 根据id删除一条记录
 */
function delete_os_id($os_id)
{
global $conn;
  $sql = "delete from os "
	. " where id = ${os_id}";
  return db_exec($sql);
}

/*
 * 点击前台 删除 按钮 执行删除操作
 */
function submit_delete_os_event($os_id)
{
  $count = get_app_file_os_id_count($os_id);
  if ($count == 0) {
    delete_os_id($os_id);
    return "true";
  } else {
    return "false";
  }
}

/*
 * 根据os_id 查询系统内容 or 更新系统数据
 */
function get_or_modify_os_id($os_id, $os_name, $os_description, $os_probe_cmd, $state)
{
  if ($state == "query") {
    $name = get_os_name($os_id);
    $description = get_os_description($os_id);
    $probe_cmd = get_os_probe_cmd($os_id);

    $arr = array ("return"=>"true", "os_id"=>$os_id, "os_name"=>$name, "os_description"=>$description, "probe_cmd"=>$probe_cmd);
    return json_encode($arr);
  } else if ($state == "update") {
    $count = update_check_os_name($os_id, $os_name);
    if ($count == 0) {
      update_os_by_os_id($os_id, addslashes($os_name), addslashes($os_description), addslashes($os_probe_cmd));

      $name = get_os_name($os_id);
      $description = get_os_description($os_id);
      $probe_cmd = get_os_probe_cmd($os_id);

      $arr = array ("return"=>"true", "os_id"=>$os_id, "os_name"=>$name, "os_description"=>$description, "probe_cmd"=>$probe_cmd);
      return json_encode($arr);
    } else {
      $arr = array ("return"=>"false");
      return json_encode($arr);
    }
  } else {
    $arr = array ("return"=>"false");
    return json_encode($arr);
  }
}

/*
 * 根据os_id 更新 os表数据
 */
function update_os_by_os_id($os_id, $os_name, $os_description, $os_probe_cmd)
{
global $conn;
  $sql = "update os set name = '${os_name}', description = '${os_description}', probe_cmd = '${os_probe_cmd}' "
	. " where id = ${os_id}";
  return db_exec($sql);
}

/*
 * 增加新系统
 */
function add_os($name, $description, $probe_cmd)
{
  $state = check_os_name($name);
  if ($state == 0) {
    $os_id = insert_os(addslashes($name), addslashes($description), addslashes($probe_cmd));
    $html = "<tr> \n"
        . " <td>${os_id}</td> \n"
        . " <td id='os_name_$(os_id)'>${name}</td> \n"
        . " <td id='os_description_${os_id}'>${description}</td> \n"
        . " <td id='os_probe_cmd_${os_id}'>${probe_cmd}</td> \n"
        . " <td> \n"
        . " <input type='hidden' name='os_id' value='${os_id}'> \n"
        . " <input type='hidden' name='os_name' value='${name}'> \n"
        . " <button id='edi_button' class='btn btn-default' data-toggle='modal'  data-target='#myModal'> \n"
        . " <i class='fa fa-pencil'></i> 编辑 \n"
        . " </button> \n"
        . " <button id='del_button' class='btn btn-default'> \n"
        . " <div class='glyphicon glyphicon-trash'></div> 删 除 \n"
        . " </button> \n"
        . " </td> \n"
        . " </tr> \n";
    return $html;
  } else {
    return "false";
  }
}
?>

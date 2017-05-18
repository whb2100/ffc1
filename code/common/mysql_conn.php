<?php
//database configure
$db_host = "127.0.0.1"; //数据库地址及端口号
$db_user = "root";//数据库连接账户
$db_password = "123456";//数据库连接密码
$db_database = "guozhou_erp";//数据库名称

$dbc = mysqli_connect ($db_host, $db_user, $db_password, $db_database);
if (!$dbc) {
	die('无法连接数据库: ' . mysql_error());
}

?>


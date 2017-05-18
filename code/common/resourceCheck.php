<?php
include 'session_init.php';

require_once '../utils/ObjectUtils.php';
require_once '../dao/Db.php';
require_once '../dao/Mapper.php';
require_once '../dao/Table.php';
require_once '../sys/data/Resource.php';
require_once '../sys/data/RoleResource.php';
require_once '../sys/data/ResourceMapper.php';
require_once '../sys/data/RoleResourceMapper.php';

use sys\data\Resource;
use sys\data\RoleResource;
use sys\data\ResourceMapper;
use sys\data\RoleResourceMapper;

$uri = $_SERVER['REQUEST_URI'];
$resurl = '';
$i = 0;
while ($i < 2) {
	$pos = strrpos($uri, '/');
	if (!$pos) {
		break;
	}
	$resurl = substr($uri, $pos).$resurl;
	$uri = substr($uri, 0, $pos);
	$i++;
}
if (strlen($resurl) > 0) {
	$resurl = substr($resurl, 1);
}
// 	echo $resurl;
$resource = new Resource();
$resource->setresource_url($resurl);
$resMapper = new ResourceMapper();
$result = $resMapper->findAll($resource);
$resUpdate = substr($resurl , 0 , 19);
if (count($result) == 0 && $resurl != "common/main.php" && $resurl != "sys/user-create.php" && $resUpdate != "sys/user-update.php") {
	echo "<script language='javascript' type='text/javascript'>";
	echo "alert('非法访问路径，请重新登录系统！');";
	echo "window.parent.location.href='../sys/index.php'";
	echo "</script>";
	return;
}
$resource_id = $result[0]['resource_id'];

$role = new RoleResource();
$role->setresource_id($resource_id);
$roleMapper = new RoleResourceMapper();
$result = $resMapper->findAll($resource);
//var_dump($result);
if (count($result) == 0 && $resurl != "common/main.php" && $resurl != "sys/user-create.php" && $resUpdate != "sys/user-update.php") {
	echo "<script language='javascript' type='text/javascript'>";
	echo "alert('当前帐号无访问权限，请重新登录系统！');";
	echo "window.parent.location.href='../sys/index.php'";
	echo "</script>";
	return;
}

?>
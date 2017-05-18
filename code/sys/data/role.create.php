<?php 
namespace sys\data;
require '../../utils/Autoloader.php';

$arr = array();
$arr = RoleFunction::createdRole($requestParamArr);
echo json_encode($arr);
?>
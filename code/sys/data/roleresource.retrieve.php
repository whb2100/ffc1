<?php 
namespace sys\data;
require '../../utils/Autoloader.php';

$arr = array();
$arr = RoleResourceFunction::retrieveRoleResource($requestParamArr);
echo json_encode($arr);
?>
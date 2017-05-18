<?php 
namespace sys\data;
require '../../utils/Autoloader.php';

$arr = array();
$arr = RoleFunction::retrieveRoleData($requestParamArr);
echo json_encode($arr);
?>
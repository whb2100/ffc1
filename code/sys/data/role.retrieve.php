<?php 
namespace sys\data;
require '../../utils/Autoloader.php';

$arr = array();
$arr = RoleFunction::retrieveRole($requestParamArr);
echo json_encode($arr);
?>
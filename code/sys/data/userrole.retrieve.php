<?php 
namespace sys\data;
require '../../utils/Autoloader.php';

$arr = array();
$arr = UserRoleFunction::retrieveRoleUser($requestParamArr);
echo json_encode($arr);
?>
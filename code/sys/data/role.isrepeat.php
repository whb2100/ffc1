<?php 
namespace sys\data;
require '../../utils/Autoloader.php';

$arr = array();
$arr = RoleFunction::roleRepeatCheck($requestParamArr);
echo json_encode($arr);
?>
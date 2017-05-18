<?php 
namespace sys\data;
require '../../utils/Autoloader.php';

$arr = array();
$arr = DepartFunction::retrieveDepartmentName($requestParamArr);
echo json_encode($arr);
?>
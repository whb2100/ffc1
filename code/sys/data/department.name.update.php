<?php 
namespace sys\data;
require '../../utils/Autoloader.php';

$arr = array();
$arr = DepartFunction::updateDepartmentName($requestParamArr);
echo json_encode($arr);
?>
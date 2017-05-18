<?php 
namespace sys\data;
require '../../utils/Autoloader.php';

$arr = array();
$arr = DepartFunction::retrieveDepartmentTree($requestParamArr);
echo json_encode($arr);
?>
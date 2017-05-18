<?php 
namespace sys\data;
require '../../utils/Autoloader.php';

$arr = array();
$arr = DepartFunction::createDepart($requestParamArr);
echo json_encode($arr);
?>
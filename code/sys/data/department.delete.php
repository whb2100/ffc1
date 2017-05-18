<?php 
namespace sys\data;
require '../../utils/Autoloader.php';

$arr = array();
$arr = DepartFunction::deleteDepart($requestParamArr);
echo json_encode($arr);
?>
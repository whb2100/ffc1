<?php 
namespace sys\data;
require '../../utils/Autoloader.php';

$arr = array();
$arr = DepartFunction::retrieveAllName($requestParamArr);
echo json_encode($arr);
?>
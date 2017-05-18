<?php 
namespace sys\data;
require '../../utils/Autoloader.php';

$arr = array();
$arr = DepartFunction::retrieveDepart($requestParamArr);
echo json_encode($arr);
?>
<?php 
namespace basic\data;
require '../../utils/Autoloader.php';

$arr = array();
$arr = FreeFunction::retrieveitemCode($requestParamArr);
echo json_encode($arr);
?>
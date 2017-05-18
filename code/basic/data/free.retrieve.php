<?php 
namespace basic\data;
require '../../utils/Autoloader.php';

$arr = array();
$arr = FreeFunction::retrieveitem($requestParamArr);
echo json_encode($arr);
?>
<?php 
namespace basic\data;
require '../../utils/Autoloader.php';

$arr = array();
$arr = RegionFunction::retrieveitemCode($requestParamArr);
echo json_encode($arr);
?>
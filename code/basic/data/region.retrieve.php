<?php 
namespace basic\data;
require '../../utils/Autoloader.php';

$arr = array();
$arr = RegionFunction::retrieveitem($requestParamArr);
echo json_encode($arr);
?>
<?php 
namespace sys\data;
require '../../utils/Autoloader.php';

$arr = array();
$arr = ResourceFunction::retrieveResourceData($requestParamArr);
echo json_encode($arr);
?>
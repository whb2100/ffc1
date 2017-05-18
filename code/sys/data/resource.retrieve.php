<?php 
namespace sys\data;
require '../../utils/Autoloader.php';

$arr = array();
$arr = ResourceFunction::retrieveResource($requestParamArr);
echo json_encode($arr);
?>
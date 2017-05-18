<?php 
namespace sys\data;
require '../../utils/Autoloader.php';

$arr = array();
$arr = ResourceFunction::retrieveAllResource($requestParamArr);
echo json_encode($arr);
?>
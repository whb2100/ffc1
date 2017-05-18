<?php 
namespace sys\data;
require '../../utils/Autoloader.php';

$arr = array();
$arr = ResourceFunction::createdResource($requestParamArr);
echo json_encode($arr);
?>
<?php 
namespace poInput\data;
require '../../utils/Autoloader.php';

$arr = array();
$arr = BatchFunction::retrieveBatchCode($requestParamArr);
echo json_encode($arr);
?>
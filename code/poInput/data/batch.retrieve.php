<?php 
namespace poInput\data;
require '../../utils/Autoloader.php';

$arr = array();
$arr = BatchFunction::retrieveitem($requestParamArr);
echo json_encode($arr);
?>
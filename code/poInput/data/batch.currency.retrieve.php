<?php 
namespace poInput\data;
require '../../utils/Autoloader.php';

$arr = array();
$arr = BatchFunction::retrievecurrency($requestParamArr);
echo json_encode($arr);
?>
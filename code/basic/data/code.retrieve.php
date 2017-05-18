<?php 
namespace basic\data;
require '../../utils/Autoloader.php';

$arr = array();
$arr = CodeFunction::retrieveitem($requestParamArr);
echo json_encode($arr);
?>
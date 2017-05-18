<?php 
namespace project\data;
require '../../utils/Autoloader.php';

$arr = array();
$arr = ProjectFunction::retrieveAll($requestParamArr);
echo json_encode($arr);
?>
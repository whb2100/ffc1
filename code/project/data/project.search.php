<?php 
namespace project\data;
require '../../utils/Autoloader.php';

$arr = array();
$arr = ProjectFunction::searchProject($requestParamArr);
echo json_encode($arr);
?>
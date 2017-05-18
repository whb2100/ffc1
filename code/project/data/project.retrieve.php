<?php 
namespace project\data;
require '../../utils/Autoloader.php';

$arr = array();
$arr = ProjectFunction::retrieveProject($requestParamArr);
echo json_encode($arr);
?>
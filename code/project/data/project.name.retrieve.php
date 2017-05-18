<?php 
namespace project\data;
require '../../utils/Autoloader.php';

$arr = array();
$arr = ProjectFunction::retrieveProjectName($requestParamArr);
echo json_encode($arr);
?>
<?php 
namespace project\data;
require '../../utils/Autoloader.php';

$arr = array();
$arr = ProjectFunction::retrieveDirector($requestParamArr);
echo json_encode($arr);
?>
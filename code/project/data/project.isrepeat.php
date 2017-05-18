<?php 
namespace project\data;
require '../../utils/Autoloader.php';

$arr = array();
$arr = ProjectFunction::projectRepeatCheck($requestParamArr);
echo json_encode($arr);
?>
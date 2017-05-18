<?php 
namespace project\data;
require '../../utils/Autoloader.php';

$arr = array();
$arr = UserFunction::userRepeatCheck($requestParamArr);
echo json_encode($arr);
?>
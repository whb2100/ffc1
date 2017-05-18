<?php 
namespace sys\data;
require '../../utils/Autoloader.php';

$arr = array();
$arr = REsourceFunction::resourceRepeatCheck($requestParamArr);
echo json_encode($arr);
?>
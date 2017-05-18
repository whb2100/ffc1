<?php 
namespace sys\data;
require '../../utils/Autoloader.php';

$arr = array();
$arr = REsourceFunction::resourceUrlRepeatCheck($requestParamArr);
echo json_encode($arr);
?>
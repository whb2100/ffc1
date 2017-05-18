<?php 
namespace sys\data;
require '../../utils/Autoloader.php';

$arr = array();
$arr = UserFunction::updateUser($requestParamArr);
echo json_encode($arr);
?>
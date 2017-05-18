<?php 
namespace sys\data;
require '../../utils/Autoloader.php';

$arr = array();
$arr = UserFunction::updateUserInfo($requestParamArr);
echo json_encode($arr);
?>
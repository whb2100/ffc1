<?php 
namespace sys\data;
require '../../utils/Autoloader.php';

$arr = array();
$arr = UserFunction::updateUserPassword($requestParamArr);
echo json_encode($arr);
?>
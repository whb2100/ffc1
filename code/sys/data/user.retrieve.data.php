<?php 
namespace sys\data;
require '../../utils/Autoloader.php';

$arr = array();
$arr = UserFunction::retrieveUserData($requestParamArr);
echo json_encode($arr);
?>
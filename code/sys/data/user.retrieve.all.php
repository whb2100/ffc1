<?php 
namespace sys\data;
require '../../utils/Autoloader.php';

$arr = array();
$arr = UserFunction::retrieveAllUser($requestParamArr);
echo json_encode($arr);
?>
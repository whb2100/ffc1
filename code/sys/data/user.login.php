<?php 
namespace sys\data;
require '../../utils/Autoloader.php';

$arr = array();
$arr = UserFunction::userLogin($requestParamArr);
echo json_encode($arr);
?>
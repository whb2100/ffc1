<?php 
namespace sys\data;
require '../../utils/Autoloader.php';

$arr = array();
$arr = UserFunction::retrieveUserResourceUrl($requestParamArr);
echo json_encode($arr);
?>
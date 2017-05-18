<?php 
namespace sys\data;
require '../../utils/Autoloader.php';

$arr = array();
$arr = UserFunction::createdRecheckUser($requestParamArr);
echo json_encode($arr);
?>
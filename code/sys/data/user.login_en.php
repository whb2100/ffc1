<?php 
namespace sys\data;
require '../../utils/Autoloader.php';

$arr = array();
$arr = UserFunction::userLogin_en($requestParamArr);
echo json_encode($arr);
?>
<?php 
namespace project\data;
require '../../utils/Autoloader.php';

$arr = array();
$arr = ProjectFunction::retrieveCompany($requestParamArr);
echo json_encode($arr);
?>
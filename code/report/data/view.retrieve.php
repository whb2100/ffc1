<?php 
namespace report\data;
require '../../utils/Autoloader.php';

$arr = array();
$arr = ReportFunction::retrieveView($requestParamArr);
echo json_encode($arr);
?>
<?php 
namespace report\data;
require '../../utils/Autoloader.php';

$arr = array();
$arr = ReportFunction::delView($requestParamArr);
echo json_encode($arr);
?>
<?php 
namespace report\data;
require '../../utils/Autoloader.php';

$arr = array();
$arr = ReportFunction::saveView($requestParamArr);
echo json_encode($arr);
?>
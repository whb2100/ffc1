<?php 
namespace report\data;
require '../../utils/Autoloader.php';

$arr = array();
$arr = ReportFunction::retrieveMain($requestParamArr,1);
echo json_encode($arr);
?>
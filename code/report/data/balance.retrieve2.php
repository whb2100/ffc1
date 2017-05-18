<?php 
namespace report\data;
require '../../utils/Autoloader.php';

$arr = array();
$arr = ReportFunction::retrieveMainSub($requestParamArr,3,4,2);
echo json_encode($arr);
?>
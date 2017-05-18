<?php 
namespace report\data;
require '../../utils/Autoloader.php';

$arr = array();
// $arr = ReportFunction::retrieveCodeNO($requestParamArr);
$arr = ReportFunction::retrieveMainSub($requestParamArr,1,1,2);
echo json_encode($arr);
?>
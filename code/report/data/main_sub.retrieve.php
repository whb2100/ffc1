<?php 
namespace report\data;
require '../../utils/Autoloader.php';

$arr = array();
$arr = ReportFunction::retrieveMainSub($requestParamArr,1,1);
echo json_encode($arr);
?>
<?php 
namespace project\data;
require '../../utils/Autoloader.php';

$arr = array();
$arr = ProjectFunction::exportPDF($requestParamArr);
echo json_encode($arr);
?>
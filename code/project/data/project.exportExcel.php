<?php 
namespace project\data;
require '../../utils/Autoloader.php';
require '../../classes/PHPExcel.php';

$arr = array();
$arr = ProjectFunction::exportExcel($requestParamArr);
echo json_encode($arr);
?>
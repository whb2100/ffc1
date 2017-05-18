<?php 
namespace basic\data;
require '../../utils/Autoloader.php';
require '../../classes/PHPExcel.php';

$arr = array();
$arr = CodeFunction::exportExcelEtc($requestParamArr);
echo json_encode($arr);
?>
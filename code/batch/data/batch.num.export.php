<?php 
namespace batch\data;
require '../../utils/Autoloader.php';
require '../../classes/PHPExcel.php';

$arr = array();
$arr = TransactionCodeFunction::exportNum($requestParamArr);
echo json_encode($arr);
?>
<?php 
namespace poInput\data;
require '../../utils/Autoloader.php';
require '../../classes/PHPExcel.php';

$arr = array();
$arr = TransactionDetailFunction::exportSub($requestParamArr);
echo json_encode($arr);
?>
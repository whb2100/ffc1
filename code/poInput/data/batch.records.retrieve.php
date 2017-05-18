<?php 
namespace poInput\data;
require '../../utils/Autoloader.php';

$arr = array();
$arr = TransactionDetailFunction::retrieveRecords($requestParamArr);
echo json_encode($arr);
?>
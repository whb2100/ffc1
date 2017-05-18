<?php 
namespace poInput\data;
require '../../utils/Autoloader.php';

$arr = array();
$arr = TransactionDetailFunction::retrieveitem($requestParamArr);
echo json_encode($arr);
?>
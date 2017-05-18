<?php 
namespace poInput\data;
require '../../utils/Autoloader.php';

$arr = array();
$arr = TransactionCodeFunction::retrieveitem($requestParamArr);
echo json_encode($arr);
?>
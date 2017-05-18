<?php 
namespace batch\data;
require '../../utils/Autoloader.php';

$arr = array();
$arr = TransactionFunction::retrieveitem($requestParamArr);
echo json_encode($arr);
?>
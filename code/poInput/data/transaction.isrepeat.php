<?php 
namespace poInput\data;
require '../../utils/Autoloader.php';

$arr = array();
$arr = TransactionFunction::itemNameCheck($requestParamArr);
echo json_encode($arr);
?>
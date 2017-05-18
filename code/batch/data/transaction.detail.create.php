<?php 
namespace batch\data;
require '../../utils/Autoloader.php';

$arr = array();
$arr = TransactionDetailFunction::createitem($requestParamArr);
echo json_encode($arr);
?>
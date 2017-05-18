<?php 
namespace basic\data;
require '../../utils/Autoloader.php';

$arr = array();
$arr = CurrencyFunction::retrieveAllitem($requestParamArr);
echo json_encode($arr);
?>
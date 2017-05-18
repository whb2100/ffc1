<?php 
namespace basic\data;
require '../../utils/Autoloader.php';

$arr = array();
$arr = CurrencyCodeFunction::retrieveitem($requestParamArr);
echo json_encode($arr);
?>
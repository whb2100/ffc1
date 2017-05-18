<?php 
namespace basic\data;
require '../../utils/Autoloader.php';

$arr = array();
$arr = CurrencyFunction::retrieveitem($requestParamArr);
echo json_encode($arr);
?>
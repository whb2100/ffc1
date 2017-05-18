<?php 
namespace basic\data;
require '../../utils/Autoloader.php';

$arr = array();
$arr = CurrencyTypeFunction::retrieveitem($requestParamArr);
echo json_encode($arr);
?>
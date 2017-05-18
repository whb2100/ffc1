<?php 
namespace budget\data;
require '../../utils/Autoloader.php';

$arr = array();
$arr = HistoryFunction::retrieveitem($requestParamArr);
echo json_encode($arr);
?>
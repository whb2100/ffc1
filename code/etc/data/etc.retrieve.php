<?php 
namespace etc\data;
require '../../utils/Autoloader.php';

$arr = array();
$arr = EtcFunction::retrieveitem($requestParamArr);
echo json_encode($arr);
?>
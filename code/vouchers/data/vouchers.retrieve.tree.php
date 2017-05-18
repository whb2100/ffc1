<?php 
namespace vouchers\data;
require '../../utils/Autoloader.php';

$arr = array();
$arr = VouchersFunction::retrieveTree($requestParamArr);
echo json_encode($arr);
?>
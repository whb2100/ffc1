<?php 
namespace vouchers\data;
require '../../utils/Autoloader.php';

$arr = array();
$arr = VouchersFunction::retrieveItem($requestParamArr);
echo json_encode($arr);
?>
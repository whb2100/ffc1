<?php 
namespace vouchers\data;
require '../../utils/Autoloader.php';

$arr = array();
$arr = VouchersFunction::vouchersRepeatCheck($requestParamArr);
echo json_encode($arr);
?>
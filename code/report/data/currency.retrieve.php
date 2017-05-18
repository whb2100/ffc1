<?php 
namespace report\data;
require '../../utils/Autoloader.php';

$arr = array();
$arr = ReportFunction::retrieveCurrency();
echo json_encode($arr);
?>
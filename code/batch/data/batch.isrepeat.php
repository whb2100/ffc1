<?php 
namespace batch\data;
require '../../utils/Autoloader.php';

$arr = array();
$arr = BatchFunction::itemNameCheck($requestParamArr);
echo json_encode($arr);
?>
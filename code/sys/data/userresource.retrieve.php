<?php 
namespace sys\data;
require '../../utils/Autoloader.php';

$arr = array();
$arr = UserFunction::retrieveUserResource();
echo json_encode($arr);
?>
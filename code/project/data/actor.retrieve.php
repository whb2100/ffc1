<?php 
namespace project\data;
require '../../utils/Autoloader.php';

$arr = array();
$arr = ProjectFunction::retrieveActor($requestParamArr);
echo json_encode($arr);
?>

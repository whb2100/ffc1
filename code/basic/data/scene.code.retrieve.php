<?php 
namespace basic\data;
require '../../utils/Autoloader.php';

$arr = array();
$arr = SceneFunction::retrieveitemCode($requestParamArr);
echo json_encode($arr);
?>
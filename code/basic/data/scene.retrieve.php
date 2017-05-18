<?php 
namespace basic\data;
require '../../utils/Autoloader.php';

$arr = array();
$arr = SceneFunction::retrieveitem($requestParamArr);
echo json_encode($arr);
?>
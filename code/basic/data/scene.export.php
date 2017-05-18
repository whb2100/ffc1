<?php 
namespace basic\data;
require '../../utils/Autoloader.php';
require '../../classes/PHPExcel.php';

$arr = array();
$arr = SceneFunction::exportItem($requestParamArr);
echo json_encode($arr);
?>
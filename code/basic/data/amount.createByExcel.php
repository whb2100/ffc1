<?php 
namespace basic\data;
require '../../utils/Autoloader.php';
require '../../classes/PHPExcel.php';

use common\Constants;
use sys\data\ResourceFunction;

// $arr = ResourceFunction::checkPermission();
// if ($arr['result'] != Constants::RESULT_CODE_SUCCESS) {
// 	echo json_encode($arr);
// 	return;
// }

$arr = array();
$excelFile = $_FILES['budgets_file'];
// var_dump($excelFile);
$arr =CodeFunction::createAmountByExcel($excelFile);
echo json_encode($arr);
?>
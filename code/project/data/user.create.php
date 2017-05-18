<?php 
namespace project\data;
require '../../utils/Autoloader.php';

use common\Constants;
use sys\data\ResourceFunction;

$arr = ResourceFunction::checkPermission();
if ($arr['result'] != Constants::RESULT_CODE_SUCCESS) {
	echo json_encode($arr);
	return;
}

$arr = array();
$arr = UserFunction::createUser($requestParamArr);
echo json_encode($arr);
?>
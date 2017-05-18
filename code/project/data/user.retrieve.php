<?php 
namespace project\data;
require '../../utils/Autoloader.php';

use common\Constants;
use sys\data\ResourceFunction;

$arr = ResourceFunction::checkPermission();
if ($arr['result'] != Constants::RESULT_CODE_SUCCESS) {
	echo json_encode(array());
	return;
}

$arr = array();
$arr = UserFunction::retrieveUser($requestParamArr);
echo json_encode($arr);
?>
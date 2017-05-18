<?php 
namespace sys\data;
require '../../utils/Autoloader.php';
require '../../classes/PHPExcel.php';

$arr = array();

$resArr = ResourceFunction::checkButton($requestParamArr);

if($resArr == '该按钮资源还未创建！'|| $resArr == '当前用户无此操作权限！'){
	$arr['msg'] = $resArr;
}else{
	$arr = UserFunction::exportItem($requestParamArr);
}
echo json_encode($arr);
?>
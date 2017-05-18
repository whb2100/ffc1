<?php

namespace sys\data;

use sys\data\User;
use utils\ObjectUtils;
use utils\ReturnResult;
use dao\Db;
use common\Constants;

include '../../common/change_language.php';

class ResourceFunction {

	public static function retrieveResourceData($paramArr){
		$arr = array();
		$resourceMapper = new ResourceMapper();
		$resource = new Resource();
		$where = 'where 1=1';
		$resourceName = $paramArr['resource_names'];
		if($resourceName != null){
			$where = $where . " and resource_name like '%" . $paramArr['resource_names'] . "%'";
		}
		$resource = ObjectUtils::arrToObj($paramArr, $resource);
		$arr = $resourceMapper->find($resource,$where);
		return $arr;
	}

	// 检查当前用户是否有操作权限
	public static function checkPermission() {
		$userId = $_SESSION[Constants::LOGINED_USER_ID_IN_SESSION];
		$position_id = $_SESSION[Constants::LOGINEN_USER_POSITION_ID_IN_SESSION];
		if ($userId == null || $position_id == null) {// 登录超时
			$arr['result'] = Constants::RESULT_CODE_LOGIN_TIME_OUT;
			$arr['msg'] = LOGIN_TIME_OUT;
			return $arr;
		}

		$mapper = new ResourceMapper();
		$user = new User();
		$sql = 'SELECT USER_STATUS,POSITION_ID FROM '.$user->tableName.' WHERE USER_ID='.$userId;
		$res1 = $mapper->conn->getOne($sql);
		if (count($res1) == 0 || $res1['user_status'] != 1) {
			$arr['result'] = Constants::RESULT_CODE_USER_DISABLE;
			$arr['msg'] = USER_DISABLE;
			return $arr;
		}
		//var_dump($sql);die;

		$url = $_SERVER['REQUEST_URI'];
		$index = stripos($url, '?');
		if ($index != null) {
			$url = substr($url, 0, $index);
		}
		$sql = "SELECT COUNT(1) AS c FROM V_SYS_ROLERESOURCE WHERE LOCATE(RESOURCE_URL,'$url')>0 AND ROLE_ID=".$res1['position_id'];
		$res2 = $mapper->conn->getOne($sql);
		//var_dump($sql);die;
		if (count($res2) == 0 || $res2['c'] == 0) {
			$arr['result'] = Constants::RESULT_CODE_USER_NO_PERMISSION;
			$arr['msg'] = USER_NO_PERMISSION;
			return $arr;
		}
		$arr['result'] = Constants::RESULT_CODE_SUCCESS;
		return $arr;
	}
}

?>
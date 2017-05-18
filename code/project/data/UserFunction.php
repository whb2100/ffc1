<?php

namespace project\data;

use utils\ObjectUtils;
use utils\ReturnResult;
use common\Constants;
use utils\ExcelUtils;

class UserFunction {
	public static function retrieveUser($paramArr,$where,$head){
		$arr = array();
		$userMapper = new UserMapper();
		$user = new User();
		$user = ObjectUtils::arrToObj($paramArr, $user);
		$arr = $userMapper->find($user,$where,'',$head,$paramArr['sort'],$paramArr['order']);
		return $arr;
	}


	public static function createUser($paramArr){
		$arr = array();
		$userMapper = new UserMapper();
		$user = new User();
		$user = ObjectUtils::arrToObj($paramArr, $user);
		$user->setUser_password(md5('123456'));
		$user->setCreate_date(date('Y-m-d H:i:s', time()));
		$user->setCreate_by($_SESSION[Constants::LOGINED_USER_ID_IN_SESSION ]);
		$user->setLast_update_date(date('Y-m-d H:i:s', time()));
		$user->setLast_update_by($_SESSION[Constants::LOGINED_USER_ID_IN_SESSION ]);
		// var_dump($user);die;
		$res = $userMapper->save($user);
		$arr = ReturnResult::returnMsg($res);
		return $arr;
	}

	public static function updateUser($paramArr){
		$arr = array();
		$userMapper = new UserMapper();
		$user = new User();
		// $user = ObjectUtils::arrToObj($paramArr, $user);
		$user->setUser_id($paramArr['user_id']);
		if ($paramArr['user_password'] != '') {
			$user->setUser_password(md5($paramArr['user_password']));
		}
		$user->setUser_realname($paramArr['user_realname']);
		$user->setUser_status($paramArr['user_status']);
		$user->setPosition_id($paramArr['position_id']);
		$user->setLast_update_date(date('Y-m-d H:i:s', time()));
		$user->setLast_update_by($_SESSION[Constants::LOGINED_USER_ID_IN_SESSION ]);
		// var_dump($user);die;
		$res = $userMapper->update($user);
		$arr = ReturnResult::returnMsg($res);
		return $arr;
	}


// 账号重复性检查
	public static function userRepeatCheck($paramArr){
		$arr = array();
		$userMapper = new UserMapper();
		$user = new User();
		// $project = ObjectUtils::arrToObj($paramArr, $project);
		$value = trim($paramArr['user_empcode']);
		$where = "where user_empcode ='$value'";
		$res = $userMapper->find($user,$where);
		// var_dump($res['rows']);die;
		if(empty($res['rows'])){
			$arr['result'] = Constants::RESULT_CODE_SUCCESS;
			// $arr['msg'] = Constants::OPERATION_SUCCESS;
		}else{
			$arr['result'] = Constants::RESULT_CODE_FAIL_REPEAT;
			// $arr['msg'] = Constants::EXIST_SAME_NAME;
		}
		return $arr;
	}


	public static function exportExcel($paramArr){
		$arr = array();
		$userMapper = new UserMapper();
		$user = new User();
		$paramArr['page'] = 1;
		$paramArr['rows'] = PHP_INT_MAX;
		$projectId = $paramArr['project_id'];
		// var_dump($paramArr);die;
		$where = "where project_id ='$projectId' ";
		$dataArray = UserFunction::retrieveUser($paramArr,$where,User::$excelHeaderFields);
		@$language = $_SESSION['language'];
		if ($language == 'en') {
			$excel_name = ExcelUtils::createExcelByModel('user',BASE_DIR.'uploads/excelModel/user-en.xls', $dataArray['rows']);
		}else{
			$excel_name = ExcelUtils::createExcelByModel('user',BASE_DIR.'uploads/excelModel/user.xls', $dataArray['rows']);
		}
		$arr['result'] = Constants::RESULT_CODE_SUCCESS;
		$arr['msg'] = $excel_name;
		return $arr;
	}

	
}

?>
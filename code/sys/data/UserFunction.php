<?php

namespace sys\data;

use utils\AgentUtils;
use utils\ObjectUtils;
use utils\ReturnResult;
use common\Constants;
use dao\Db;
use changeLog\data\ChangeLogFunction;
use utils\ExcelUtils;
use project\data\ProjectFunction;

class UserFunction {

	public static function createdUser($paramArr){
		$userMapper = new UserMapper();
		$user = new User();
		$user = ObjectUtils::arrToObj($paramArr, $user);
		if($paramArr['user_password'] != null){
			$user->setUser_password(md5($paramArr['user_password']));
		}
		$user->setCreate_date(date('Y-m-d H:i:s', time()));
		$user->setCreate_by($_SESSION[Constants::LOGINED_USER_ID_IN_SESSION]);
		$userId = $userMapper->save($user);
		$user->setLast_recheck_user_id($userId);
		$userMapper->update($user);
		if($userId){
			$role_ids = $paramArr['role_ids'];
			$role_id_array = explode(',',$role_ids);
			foreach ($role_id_array as $role_id){
				UserRoleFunction::createdUserRole(array('user_id'=>$userId,'role_id'=>$role_id));
			}
		}
		$arr = ReturnResult::returnMsg($userId);
		return $arr;
	}

	public static function retrieveUser($paramArr){
		$arr = array();
		$userMapper = new UserMapper();
		$user = new User();
		$where = " where 1=1 ";
		$userId = trim($paramArr['userId']);
		$pwd = $paramArr['pwd'];
		if($userId != null && $userId != ""){
			$where.= " and user_id = $userId";
		}
		if($pwd != null && $pwd != ""){
			$pwd = md5($paramArr['pwd']);
			$where.= " and user_password = '$pwd'";
		}
		$user = ObjectUtils::arrToObj($paramArr, $user);
		$arr = $userMapper->find($user,$where);
		return $arr;
	}

	public static function retrieveAllUser($paramArr){
		$arr = array();
		$where = ' WHERE 1=1';
		$where .= AgentUtils::agentArr($paramArr['user_codes'], 'user_empcode');
		if ($paramArr['dept_code'] != null) {
			$dept_code = $paramArr['dept_code'];
			$where .= " AND DEPT_CODE LIKE '$dept_code%'";
		}
		if ($paramArr['user_status'] != null) {
			$user_status = $paramArr['user_status'];
			$where .= " AND user_status = $user_status";
		}
		$userMapper = new UserMapper();
		$user = new User();
		//$user = ObjectUtils::arrToObj($paramArr, $user);
		$arr = $userMapper->findAll($user, $where);
		return $arr;
	}

	public static function retrieveUserData($paramArr){
		$arr = array();
		$userMapper = new UserMapper();
		$user = new User();
		$where = 'where 1=1';
		$deptId = $paramArr['dept_id'];
		if($deptId != null){
			$sql = 'select DEPT_ID AS DEPART_ID from V_SYS_DEPARTMENT start with dept_id ='.$deptId.'connect by prior dept_id = parent_id';
			$res = Db::getInstance()->getAll($sql);
			$deptArray = array();
			$result = array();
			$i = 0;
			foreach ($res as $deptId){
				$departIdVal = $deptId['depart_id'];
				if($i == 0){
					$where .= " and ( depart_id = $departIdVal ";
				}else{
					$where .= " or depart_id = $departIdVal ";
				}
				$i++;
			}
			$where .= ') ';
		}
		$userRealName = $paramArr['user_names'];
		if($userRealName != null){
			$where = $where . " and user_realname like '%" . $paramArr['user_names'] . "%'";
		}
		$userName = $paramArr['user_empcodes'];
		if($userName != null){
			$where = $where . " and user_empcode like '%" . $paramArr['user_empcodes'] . "%'";
		}
		$departId = $paramArr['depart_id'];
		if($departId != null){
			$where = $where . " and depart_id =" . $departId;
		}
		$parentId = $paramArr['parent_id'];
		if($parentId != null){
			$where = $where . " and create_name =" . $parentId;
		}
		$user = ObjectUtils::arrToObj($paramArr, $user);
		$arr = $userMapper->find($user,$where);
		return $arr;
	}

	public static function updateUser($paramArr){
		$userMapper = new UserMapper();
		$user = new User();
		$user = ObjectUtils::arrToObj($paramArr, $user);
		$res = $userMapper->update($user);

		UserRoleFunction::deleteRoleUser(array('user_id'=>$paramArr['user_id']));
		$role_ids = $paramArr['role_ids'];
		$role_id_array = explode(',',$role_ids);
		foreach ($role_id_array as $role_id){
			UserRoleFunction::createdUserRole(array('user_id'=>$paramArr['user_id'],'role_id'=>$role_id));
		}
		$arr = ReturnResult::returnMsg($res);
		return $arr;
	}

	public static function createdRecheckUser($paramArr){
		$userMapper = new UserMapper();
		$user = new User();
		$jsonArray = json_decode(stripcslashes($paramArr['users_data']),true);
		foreach ($jsonArray as $value){
			$user->setuser_id($value['user_id']);
			$user->setAllow_submit_recheck($value['allow_submit_recheck']);
			$user->setAllow_receive_recheck($value['allow_receive_recheck']);
			$res = $userMapper->update($user);
		}

		$arr = ReturnResult::returnMsg($res);
		return $arr;
	}

	public static function updateUserInfo($paramArr){
		$userMapper = new UserMapper();
		$user = new User();
		$user = ObjectUtils::arrToObj($paramArr, $user);
		$res = $userMapper->update($user);
		$arr = ReturnResult::returnMsg($res);
		return $arr;
	}

	//导出
	public static function exportItem($paramArr){
		$arr = array();
		$itemMapper = new UserMapper();
		$item = new User();
		$searchObj = new UserSearchCondition();
		$searchObj = ObjectUtils::arrToSearchObj($paramArr, $searchObj);
		$where = ' WHERE 1=1 ';
		$paramValue = $paramArr['user_empcodes'];
		if($paramValue != null){
			$where .= " and user_empcode like '%" . $paramValue . "%'";
		}

		$item->page = 1;
		$item->rows = PHP_INT_MAX;
		$dataArray = $itemMapper->find($item, $where, '', User::$excelHeaderFields);
		for ($i=0; $i <count($dataArray['rows']) ; $i++) {
			$rs[$i]=$item->formatterObjByExcel($dataArray['rows'][$i]);
		}
		$types = $itemMapper->getColType($item->tableView, User::$excelHeaderFields);
		$excel_name = ExcelUtils::createExcelByModel('user',
		BASE_DIR.'uploads/excelModel/user.xls', $rs, null, null, null, $searchObj, null, $types);
		$arr['result'] = Constants::RESULT_CODE_SUCCESS;
		$arr['msg'] = $excel_name;
		return $arr;
	}

	public static function updateUserPassword($paramArr){

		$userId = $_SESSION[Constants::LOGINED_USER_ID_IN_SESSION];

		$userMapper = new UserMapper();
		$user = new User();
		$user->setUser_id($userId);
		$resultArray = $userMapper->find($user);
		$res = $resultArray['rows'];
		if(count($res) === 1){
			if($res[0]['user_password'] == md5($paramArr['user_oldPassword'])){
				$user->setUser_password(md5($paramArr['user_newPassword']));
				$user->setLast_modify_pwd_date(date('Y-m-d H:i:s', time()));
				$res = $userMapper->update($user);
				$arr = ReturnResult::returnMsg($res);
			}else{
				$arr['result'] = Constants::RESULT_CODE_FAIL_PASSWORD;
				$arr['msg'] = Constants::USER_PASSWORD_INCORRECT;
			}
		}
		return $arr;
	}

	private static function clearSession($userMapper, $user) {
		if ($user['session_id'] != null && $user['session_id'] != session_id()) {// 清除旧的session
			$path = session_save_path();
			unlink($path.'/sess_'.$user['session_id']);
		}
		$sql = "UPDATE T_SYS_USER SET SESSION_ID='".session_id()."' WHERE USER_ID=".$user['user_id'];
		$userMapper->conn->exec($sql);
	}
	
	
	// 中文登录
	public static function userLogin($paramArr) {
		$arr = array();
		$userMapper = new UserMapper();
		$user_empcode = $paramArr['user_empcode'];
		$user_password = md5($paramArr['user_password']);
		$where = " where 1=1 and user_status = 1";
		$where .= " and user_empcode = '$user_empcode' and user_password = '$user_password' ";
		$resultArray = $userMapper->find(new User(), $where);
		$res = $resultArray['rows'];
		if(count($res) === 1) {
			$_SESSION[Constants::LOGINED_USER_CODE_IN_SESSION] = $res[0]['user_empcode'];
			$_SESSION[Constants::LOGINED_USER_NAME_IN_SESSION ] = $res[0]['user_realname'];
			$_SESSION[Constants::LOGINED_USER_ID_IN_SESSION ] = $res[0]['user_id'];
			$_SESSION[Constants::LOGINEN_USER_POSITION_ID_IN_SESSION] = $res[0]['position_id'];
			$_SESSION[Constants::LOGINEN_USER_LOGIN_DATE_IN_SESSION] = date('Y-m-d H:i:s', time());
			$_SESSION[Constants::LOGINEN_USER_PROJECT_ID_IN_SESSION] = $res[0]['project_id'];
			$_SESSION['language'] = "zh";
			$arr['result'] = Constants::RESULT_CODE_SUCCESS;
			$arr['msg'] = Constants::CHECK_CORRECT;
			UserFunction::clearSession($userMapper, $res[0]);
			// 获取项目名称

			if ($res[0]['project_id'] != '0') {
				$project['project_id'] = $res[0]['project_id'];
				$pro = ProjectFunction::retrieveProject($project);
				$_SESSION[Constants::LOGINEN_USER_PROJECT_NAME_IN_SESSION] = $pro['rows'][0]['project_name'];
			}else{
				$_SESSION[Constants::LOGINEN_USER_PROJECT_NAME_IN_SESSION] = '';
			}
			


		} else {
			$arr['result'] = Constants::RESULT_CODE_FAIL_LOGIN;
			$arr['msg'] = Constants::USER_NAME_NOT_MATCH_PASSWORD;
		}
		return $arr;
	}

	// 英文登录
	public static function userLogin_en($paramArr){
		$arr = array();
		$userMapper = new UserMapper();
		$user_empcode = $paramArr['user_empcode'];
		$user_password = md5($paramArr['user_password']);
		$where = " where 1=1 and user_status = 1";
		$where .= " and user_empcode = '$user_empcode' and user_password = '$user_password' ";
		$resultArray = $userMapper->find(new User(), $where);
		$res = $resultArray['rows'];

		if(count($res) === 1) {
			$_SESSION[Constants::LOGINED_USER_CODE_IN_SESSION] = $res[0]['user_empcode'];
			$_SESSION[Constants::LOGINED_USER_NAME_IN_SESSION ] = $res[0]['user_realname'];
			$_SESSION[Constants::LOGINED_USER_ID_IN_SESSION ] = $res[0]['user_id'];
			$_SESSION[Constants::LOGINEN_USER_POSITION_ID_IN_SESSION] = $res[0]['position_id'];
			$_SESSION[Constants::LOGINEN_USER_LOGIN_DATE_IN_SESSION] = date('Y-m-d H:i:s', time());
			$_SESSION[Constants::LOGINEN_USER_PROJECT_ID_IN_SESSION] = $res[0]['project_id'];
			$_SESSION['language'] = "en";
			$arr['result'] = Constants::RESULT_CODE_SUCCESS;
			$arr['msg'] = Constants::CHECK_CORRECT;
			UserFunction::clearSession($userMapper, $res[0]);
			// 获取项目名称
			if ($res[0]['project_id'] != '0') {
				$project['project_id'] = $res[0]['project_id'];
				$pro = ProjectFunction::retrieveProject($project);
				$_SESSION[Constants::LOGINEN_USER_PROJECT_NAME_IN_SESSION] = $pro['rows'][0]['project_name'];
			}else{
				$_SESSION[Constants::LOGINEN_USER_PROJECT_NAME_IN_SESSION] = '';
			}
		} else {
			$arr['result'] = Constants::RESULT_CODE_FAIL_LOGIN;
			$arr['msg'] =" Username or password does not match. Please re-enter !";
		}
		return $arr;
	}

	public static function retrieveUserResource($paramArr){

		//根据用户ID获取用户角色ID
		$userRoleArray = UserRoleFunction::retrieveRoleUser(array('user_id'=>$_SESSION[Constants::LOGINED_USER_ID_IN_SESSION ]));
		$role_Ids = '';
		foreach ($userRoleArray as $userRole){
			//var_dump($userRole);
			if($role_Ids != null){
				$role_Ids .= ',';
			}
			$role_Ids .= $userRole['role_id'];
		}

		//根据用户角色获取用户权限ID
		$roleResource = new RoleResource();
		$resource = new Resource();
		$role = new Role();
		$select = "select distinct " . $resource->primaryKey . " from " . $roleResource->tableName;
		$where = " where 1=1 and $role->primaryKey in ($role_Ids) order by resource_id";
		// 		echo $select.$where;
		$res = Db::getInstance()->getAll($select.$where);
		$result = array();
		$resourceArray = array();
		$i = 0;
		foreach ($res as $resourceIdArray){
			$resourceResult = ResourceFunction::retrieveResource($resourceIdArray);
			$resourceArray[$i] = $resourceResult['rows'][0];
			$i++;
		}
		$result =UserFunction::arrayToTree($resourceArray,'resource_id','resourceparent_id','children');
		$key =array_keys($result);
		for ($i=0; $i <count($result) ; $i++) {
			$arr[$i]= $result[$key[$i]];
		}
		// var_dump($arr);die;
		return $arr;
	}

	public static function userRepeatCheck($paramArr){
		$arr = array();
		$userMapper = new UserMapper();
		$user = new User();
		$user = ObjectUtils::arrToObj($paramArr, $user);

		$res = $userMapper->findAll($user);
		if(empty($res)){
			$arr['result'] = Constants::RESULT_CODE_SUCCESS;
			$arr['msg'] = Constants::OPERATION_SUCCESS;
		}else{
			$arr['result'] = Constants::RESULT_CODE_FAIL_REPEAT;
			$arr['msg'] = Constants::EXIST_SAME_NAME;
		}
		return $arr;
	}

	public static function retrieveUserByUserIds($uids) {
		$arrIds = explode(',', $uids);
		$newIds = array_unique($arrIds);
		$where = '';
		foreach ($newIds as $value) {
			if ($where == '') {
				$where = ' and (user_id=' . $value;
			} else {
				$where = $where . ' or user_id=' . $value;
			}
		}
		if ($where != '') {
			$where = $where . ')';
		}
		$sql = 'select * from t_sys_user where 1=1 ' . $where;
		$userMapper = new UserMapper();
		$rs['rows'] = $userMapper->findBySQL($sql);
		return $rs;
	}


	public static	function arrayToTree($sourceArr, $key, $parentKey, $childrenKey){
		$tempSrcArr = array();

		$allRoot = TRUE;
		foreach ($sourceArr as  $v){
			$isLeaf = TRUE;
			foreach ($sourceArr as $cv ){
				if (($v[$key]) != $cv[$key]){
					if ($v[$key] == $cv[$parentKey]){
						$isLeaf = FALSE;
					}
					if ($v[$parentKey] == $cv[$key]){
						$allRoot = FALSE;
					}
				}
			}
			if ($isLeaf){
				$leafArr[$v[$key]] = $v;
			}
			$tempSrcArr[$v[$key]] = $v;
		}
		if ($allRoot){
			return $tempSrcArr;
		}
		else{
			unset($v, $cv, $sourceArr, $isLeaf);
			foreach ($leafArr as  $v){
				if (isset($tempSrcArr[$v[$parentKey]])){
					$tempSrcArr[$v[$parentKey]][$childrenKey] = (isset($tempSrcArr[$v[$parentKey]][$childrenKey]) && is_array($tempSrcArr[$v[$parentKey]][$childrenKey])) ? $tempSrcArr[$v[$parentKey]][$childrenKey] : array();
					array_push ($tempSrcArr[$v[$parentKey]][$childrenKey], $v);
					unset($tempSrcArr[$v[$key]]);
				}
			}
			unset($v);
			return UserFunction::arrayToTree($tempSrcArr, $key, $parentKey, $childrenKey);
		}
	}

	public static function retrieveUserResourceUrl($paramArr){
		// 根据用户ID获取用户角色ID
		$userRoleArray = UserRoleFunction::retrieveRoleUser(array('user_id'=>$_SESSION[Constants::LOGINED_USER_ID_IN_SESSION ]));
		$role_Ids = '';
		foreach ($userRoleArray as $userRole){
			//var_dump($userRole);
			if(!empty($role_Ids)){
				$role_Ids .= ',';
			}
			$role_Ids .= $userRole['role_id'];
		}
		$arr = array();
		if ($role_Ids == '') {
			return $arr;
		}
		$sql = "SELECT DISTINCT resource_url FROM T_SYS_RESOURCE a LEFT JOIN
			T_SYS_ROLERESOURCE b ON a.resource_id=b.resource_id WHERE b.role_id in ($role_Ids)";
		
		$res = Db::getInstance()->getAll($sql);
		foreach ($res as $val) {
			array_push($arr, $val['resource_url']);
		}
		return $arr;
	}
}

?>
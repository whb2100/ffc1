<?php

namespace sys\data;

use utils\ObjectUtils;
use utils\ReturnResult;
use dao\Db;
use common\Constants;
use utils\ExcelUtils;

class RoleFunction {
	
	public static function createdRole($paramArr){
		$roleMapper = new RoleMapper();
		$role = new Role();
		$role = ObjectUtils::arrToObj($paramArr, $role);
		$role->setCreate_date(date('Y-m-d H:i:s', time()));
		$role->setCreate_by($_SESSION[Constants::LOGINED_USER_ID_IN_SESSION]);
		$res = $roleMapper->save($role);
		if($res){
			$resource_ids = $paramArr['resource_ids'];
			$resource_id_array = explode(',',$resource_ids);
			foreach ($resource_id_array as $resource_id){
				RoleResourceFunction::createdRoleResource(array('role_id'=>$res,'resource_id'=>$resource_id));
			}
		}
		$arr = ReturnResult::returnMsg($res);
		return $arr;
	}
	
	public static function retrieveRole($paramArr){
		$arr = array();
		$roleMapper = new RoleMapper();
		$role = new Role();
		$role = ObjectUtils::arrToObj($paramArr, $role);
		$arr = $roleMapper->find($role);
		return $arr;
	}
	
	public static function retrieveRoleData($paramArr){
		$arr = array();
		$roleMapper = new RoleMapper();
		$role = new Role();
		$where = 'where 1=1';
		$roleName = $paramArr['role_names'];
		if($roleName != null){
			$where = $where . " and role_name like '%" . $paramArr['role_names'] . "%'";
		}
		$role = ObjectUtils::arrToObj($paramArr, $role);
		$arr = $roleMapper->find($role,$where);
		return $arr;
	}
	
	public static function updateRole($paramArr){
		$roleMapper = new RoleMapper();
		$role = new Role();
		$role = ObjectUtils::arrToObj($paramArr, $role);
		$res = $roleMapper->update($role);
		
		RoleResourceFunction::deleteRoleResource(array('role_id'=>$paramArr['role_id']));
		$resource_ids = $paramArr['resource_ids'];
		$resource_id_array = explode(',',$resource_ids);
		foreach ($resource_id_array as $resource_id){
			RoleResourceFunction::createdRoleResource(array('role_id'=>$paramArr['role_id'],'resource_id'=>$resource_id));
		}
		
		$arr = ReturnResult::returnMsg($res);
		return $arr;
	}
	
	//导出
	public static function exportItem($paramArr){
		$arr = array();
		$itemMapper = new RoleMapper();
		$item = new Role();
		$searchObj = new RoleSearchCondition();
		$searchObj = ObjectUtils::arrToSearchObj($paramArr, $searchObj);
		$where = ' WHERE 1=1 ';
		$paramValue = $paramArr['role_names'];
		if($paramValue != null){
			$where .= " and role_name like '%" . $paramValue . "%'";
		}
	
		$item->page = 1;
		$item->rows = PHP_INT_MAX;
		$dataArray = $itemMapper->find($item, $where, '', Role::$excelHeaderFields);
		for ($i=0; $i <count($dataArray['rows']) ; $i++) {
			$rs[$i]=$item->formatterObjByExcel($dataArray['rows'][$i]);
		}
		$types = $itemMapper->getColType($item->tableView, Role::$excelHeaderFields);
		$excel_name = ExcelUtils::createExcelByModel('role',
				BASE_DIR.'uploads/excelModel/role.xls', $rs, null, null, null, $searchObj, null, $types);
		$arr['result'] = Constants::RESULT_CODE_SUCCESS;
		$arr['msg'] = $excel_name;
		return $arr;
	}
	
	public static function roleRepeatCheck($paramArr){
		$arr = array();
		$roleMapper = new RoleMapper();
		$role = new Role();
		$role = ObjectUtils::arrToObj($paramArr, $role);
	
		$res = $roleMapper->findAll($role);
		if(empty($res)){
			$arr['result'] = Constants::RESULT_CODE_SUCCESS;
			$arr['msg'] = Constants::OPERATION_SUCCESS;
		}else{
			$arr['result'] = Constants::RESULT_CODE_FAIL_REPEAT;
			$arr['msg'] = Constants::EXIST_SAME_NAME;
		}
		return $arr;
	}
}

?>
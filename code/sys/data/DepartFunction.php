<?php

namespace sys\data;

use utils\ObjectUtils;
use utils\ReturnResult;
use dao\Db;
use common\Constants;

class DepartFunction {
	public static function retrieveDepart($paramArr) {
		$arr = array();
		$departmentMapper = new DepartMapper();
		$department = new Department();
		$department = ObjectUtils::arrToObj($paramArr, $department);
		$arr = $departmentMapper->find($department,null,null,null,'dept_code','ASC');
		return $arr;
	}
	
	public static function createDepart($paramArr) {
		$arr = array();
		$departmentMapper = new DepartMapper();
		$department = new Department();
		$department = ObjectUtils::arrToObj($paramArr, $department);
		$departmentCode = '';
		$lastId = $departmentMapper->save($department);
		$department->setdept_id($lastId);
		$parentId = $department->getparent_id();
		
		$sql = "select count(1) from ".$department->tableName;
		if($parentId == 1){
			$where = ' where parent_id = 1 ';
			$totalFirst = Db::getInstance()->getTotal($sql.$where);
			$departmentCode = '01'.sprintf('%02d',$totalFirst);
		}else if($parentId != 1){
			$where = ' where parent_id = '.$parentId;
			$totalSecond = Db::getInstance()->getTotal($sql.$where);
			$departmentCode = $paramArr['dept_code'].sprintf('%02d',$totalSecond);
		}
		
		$department->setdept_code($departmentCode);
		$departmentMapper->update($department);
		
		$arr = ReturnResult::returnMsg($lastId);
		return $arr;
	}
	
	public static function updateDepartmentName($paramArr) {
		$arr = array();
		$departmentMapper = new DepartMapper();
		$department = new Department();
		$department = ObjectUtils::arrToObj($paramArr, $department);
		$parentId = $paramArr['parent_id'];
		
		$sql = "select count(1) from ".$department->tableName;
		
		if($parentId == 1){
			$where = ' where parent_id = 1 ';
			$totalFirst = Db::getInstance()->getTotal($sql.$where);
			$departmentCode = '01'.sprintf('%02d',$totalFirst);
		}else if($parentId != 1){
			$where = ' where parent_id = '.$parentId;
			$totalSecond = Db::getInstance()->getTotal($sql.$where);
			$departmentCode = $paramArr['dept_code'].sprintf('%02d',$totalSecond);
		}
		
		$department->setdept_code($departmentCode);
		
		$res = $departmentMapper->update($department);
		$arr = ReturnResult::returnMsg($res);
		return $arr;
	}
	
	public static function deleteDepart($paramArr) {
		$arr = array();
		$departmentMapper = new DepartMapper();
		$department = new Department();
		$department = ObjectUtils::arrToObj($paramArr, $department);
		$res = $departmentMapper->findAll($department);
		if (count($res) == 0) {
			return false;
		}
		$dept_code = $res[0]['dept_code'];
		$sql = "SELECT COUNT(1) AS c FROM V_SYS_USER WHERE DEPT_CODE LIKE '$dept_code%'";
		$res = $departmentMapper->conn->getAll($sql);
		if (count($res) == 0) {
			return false;
		}
// 		var_dump($res);die;
		if ($res[0]['c'] > 0) {// 提示该部门有坐席人员 不能删除
			$arr['result'] = 10001;
			$arr['msg'] = "该部门有坐席人员不允许删除！";
			return $arr;
		}
		
		$res = $departmentMapper->delete($department);
		$arr = ReturnResult::returnMsg($res);
		return $arr;
	}
	
	public static function retrieveDepartmentTree($paramArr) {
		$arr = array();
		$departmentMapper = new DepartMapper();
		$department = new Department();
		$department = ObjectUtils::arrToObj($paramArr, $department);
		$arr = $departmentMapper->findAll($department);
		return $arr;
	}
	
	//查询部门全称
	public static function retrieveDepartmentName($paramArr) {
		$deptId = $paramArr['dept_id'];
		$sql = 'select * from T_SYS_DEPARTMENT START WITH DEPT_ID in
					(select distinct '.$deptId.' from T_SYS_DEPARTMENT ) 
					CONNECT BY PRIOR PARENT_ID=DEPT_ID ORDER BY DEPT_ID';
		$res = Db::getInstance()->getAll($sql);
		$result = array();
		$name = '';
		unset($res[0]);
		foreach($res as $depart){
			$deptName = $depart['dept_name'];
				$name .= "$deptName";
		}
		$result['name'] = $name;
		return $result;
	}
	
	
	public static function retrieveAllName($paramArr) {
		$arr = array();
		$where = "where 1 = 1  ";
		$deptMapper = new DepartMapper();
		$dept = new Department();

		$dept = ObjectUtils::arrToObj($paramArr, $dept);
		$arr = $deptMapper->findAll($dept);
		for ($i = 0; $i < count($arr); $i++) {
			$arr1[$i]['id'] = $arr[$i]['dept_code'];
			$arr1[$i]['text'] = $arr[$i]['dept_name'];
			$arr1[$i]['parent_id'] = $arr[$i]['parent_id'];
			$arr1[$i]['dept_code'] = $arr[$i]['dept_id'];
		}

		$result = DepartFunction::arrayToTree($arr1, 'dept_code', 'parent_id', 'children');
		$res[0] = $result[1];
		return $res;
	}

	public static	function arrayToTree($sourceArr, $key, $parentKey, $childrenKey){
		$tempSrcArr = array();
		$allRoot = TRUE;
		foreach ($sourceArr as  $v) {
			$isLeaf = TRUE;
			foreach ($sourceArr as $cv ) {
				if (($v[$key]) != $cv[$key]) {
					if ($v[$key] == $cv[$parentKey]) {
						$isLeaf = FALSE;
					}
					if ($v[$parentKey] == $cv[$key]) {
						$allRoot = FALSE;
					}
				}
			}
			if ($isLeaf) {
				$leafArr[$v[$key]] = $v;
			}
			$tempSrcArr[$v[$key]] = $v;
		}
		if ($allRoot) {
			return $tempSrcArr;
		} else {
			unset($v, $cv, $sourceArr, $isLeaf);
			foreach ($leafArr as  $v) {
				if (isset($tempSrcArr[$v[$parentKey]])) {
					$tempSrcArr[$v[$parentKey]][$childrenKey] = (isset($tempSrcArr[$v[$parentKey]][$childrenKey]) && is_array($tempSrcArr[$v[$parentKey]][$childrenKey])) ? $tempSrcArr[$v[$parentKey]][$childrenKey] : array();
					array_push($tempSrcArr[$v[$parentKey]][$childrenKey], $v);
					unset($tempSrcArr[$v[$key]]);
				}
			}
			unset($v);
			return DepartFunction::arrayToTree($tempSrcArr, $key, $parentKey, $childrenKey);
		}
	}
}

?>
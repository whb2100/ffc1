<?php

namespace sys\data;

use utils\ObjectUtils;

class UserRoleFunction {
	
	public static function createdUserRole($paramArr){
		$userRoleMapper = new UserRoleMapper();
		$userRole = new UserRole();
		$userRole = ObjectUtils::arrToObj($paramArr, $userRole);
		$userRoleMapper->save($userRole);
		return;
	}
	
	public static function retrieveRoleUser($paramArr){
		$userRoleMapper = new UserRoleMapper();
		$userRole = new UserRole();
		$userRole = ObjectUtils::arrToObj($paramArr, $userRole);
		$arr = $userRoleMapper->findAll($userRole);
		return $arr;
	}
	
	public static function deleteRoleUser($paramArr){
		$userRoleMapper = new UserRoleMapper();
		$userRole = new UserRole();
		$userRole = ObjectUtils::arrToObj($paramArr, $userRole);
		$res = $userRoleMapper->delete($userRole);
	}
}

?>
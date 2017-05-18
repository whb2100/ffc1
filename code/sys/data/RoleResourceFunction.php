<?php

namespace sys\data;

use utils\ObjectUtils;

class RoleResourceFunction {
	
	public static function createdRoleResource($paramArr){
		$roleResourceMapper = new RoleResourceMapper();
		$roleResource = new RoleResource();
		$roleResource = ObjectUtils::arrToObj($paramArr, $roleResource);
		$roleResourceMapper->save($roleResource);
		return;
	}
	
	public static function retrieveRoleResource($paramArr){
		$arr = array();
		$roleResourceMapper = new RoleResourceMapper();
		$roleResource = new RoleResource();
		$roleResource = ObjectUtils::arrToObj($paramArr, $roleResource);
		$arr = $roleResourceMapper->findAll($roleResource);
		return $arr;
	}
	
	public static function deleteRoleResource($paramArr){
		$roleResourceMapper = new RoleResourceMapper();
		$roleResource = new RoleResource();
		$roleResource = ObjectUtils::arrToObj($paramArr, $roleResource);
		$res = $roleResourceMapper->delete($roleResource);
	}
}

?>
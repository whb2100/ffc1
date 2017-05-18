<?php

namespace sys\data;

use dao\Table;

class RoleResource extends Table{
	public $tableName = 'T_SYS_ROLERESOURCE';
	public $tableView = 'V_SYS_ROLERESOURCE';
	public $primaryKey = 'roleresource_id';
	public $sequenceName = 'S_T_SYS_ROLERESOURCE';
	
	protected $roleresource_id;
	protected $role_id;
	protected $resource_id;
	
	public static $tablefields = array(
			'roleresource_id',
			'role_id',
			'resource_id',
	);
	public function getroleresource_id() {
		return $this->roleresource_id;
	}
	
	public function setroleresource_id($roleresource_id) {
		return $this->roleresource_id=$roleresource_id;
	}
	
	public function getrole_id() {
		return $this->role_id;
	}
	
	public function setrole_id($role_id) {
		return $this->role_id=$role_id;
	}
	
	public function getresource_id() {
		return $this->resource_id;
	}
	
	public function setresource_id($resource_id) {
		return $this->resource_id=$resource_id;
	}
	
}

?>
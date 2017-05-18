<?php

namespace sys\data;

use dao\Table;

class UserRole extends Table{
	public $tableName = 'T_SYS_USERROLE';
	public $tableView = 'V_SYS_USERROLE';
	public $primaryKey = 'userrole_id';
	public $sequenceName = 'S_T_SYS_USERROLE';
	
	protected $userrole_id;
	protected $user_id;
	protected $role_id;
	
	public static $tablefields = array(
			'userrole_id',
			'user_id',
			'role_id',
	);
	
	public function getuserrole_id() {
		return $this->userrole_id;
	}
	
	public function setuserrole_id($userrole_id) {
		return $this->userrole_id=$userrole_id;
	}
	
	public function getuser_id() {
		return $this->user_id;
	}
	
	public function setuser_id($user_id) {
		return $this->user_id=$user_id;
	}
	
	public function getrole_id() {
		return $this->role_id;
	}
	
	public function setrole_id($role_id) {
		return $this->role_id=$role_id;
	}
	
}

?>
<?php

namespace sys\data;

use dao\Table;

class Role extends Table{
	public $tableName = 'T_SYS_ROLE';
	public $tableView = 'V_SYS_ROLE';
	public $primaryKey = 'role_id';
	public $sequenceName = 'S_T_SYS_ROLE';
	
	protected $role_id;
	protected $role_code;
	protected $role_name;
	protected $role_desc;
	protected $create_date;
	protected $create_by;
	protected $create_name;
	protected $role_status;
	protected $store_id;
	
	public static $tablefields = array(
			'role_id',
			'role_code',
			'role_name',
			'role_desc',
			'create_date',
			'create_by',
			'create_name',
			'role_status',
			'store_id',
	);
	
	public static $excelHeaderFields = array(
			'role_name',
			'role_status',
			'create_date',
			'create_name'
	);
	
	public function getrole_id() {
		return $this->role_id;
	}
	
	public function setrole_id($role_id) {
		return $this->role_id=$role_id;
	}
	
	public function getrole_code() {
		return $this->role_code;
	}
	
	public function setrole_code($role_code) {
		return $this->role_code=$role_code;
	}
	
	public function getrole_name() {
		return $this->role_name;
	}
	
	public function setrole_name($role_name) {
		return $this->role_name=$role_name;
	}
	
	public function getrole_desc() {
		return $this->role_desc;
	}
	
	public function setrole_desc($role_desc) {
		return $this->role_desc=$role_desc;
	}
	
	public function getcreate_date() {
		return $this->create_date;
	}
	
	public function setcreate_date($create_date) {
		return $this->create_date=$create_date;
	}
	
	public function getcreate_by() {
		return $this->create_by;
	}
	
	public function setcreate_by($create_by) {
		return $this->create_by=$create_by;
	}
	
	public function getcreate_name() {
		return $this->create_name;
	}
	
	public function setcreate_name($create_name) {
		return $this->create_name=$create_name;
	}
	
	public function getrole_status() {
		return $this->role_status;
	}
	
	public function setrole_status($role_status) {
		return $this->role_status=$role_status;
	}
	
	public function getstore_id() {
		return $this->store_id;
	}
	
	public function setstore_id($store_id) {
		return $this->store_id=$store_id;
	}
	
	public static $statu = array(
			'0' => '不可用',
			'1' => '正常',
	);
	
	public function formatterObjByExcel($objArr){
		foreach ($objArr as $key => $value){
			if($value === null){
				$objArr[$key] = '';
			}
			switch ($key) {
	
				case 'role_status':
					foreach (self::$statu as $statu_key => $statu_value){
						if($value == $statu_key){
							$objArr['role_status'] = $statu_value;
						}
					}
					break;
	
				default:
					;
					break;
			}
		}
		return $objArr;
	}
	
}

?>
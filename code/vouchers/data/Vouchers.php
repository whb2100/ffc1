<?php
namespace vouchers\data;

use dao\Table;

class Vouchers extends Table {

	public $tableName = 'T_BIZ_VOUCHERS_INFO';
	public $tableView = 'T_BIZ_VOUCHERS_INFO';
	public $primaryKey = 'vouchers_id';

	protected $vouchers_id;
	protected $project_id;
	protected $vouchers_name;
	protected $vouchers_type;
	protected $vouchers_pic;
	protected $create_date;
	protected $create_by;
	
	public static $tablefields = array(
		'vouchers_id',
		'project_id',
		'vouchers_name',
		'vouchers_type',
		'vouchers_pic',
		'create_date',
		'create_by'
	);
	
	public function getvouchers_id() {
		return $this->vouchers_id;
	}
	
	public function setvouchers_id($vouchers_id) {
		return $this->vouchers_id=$vouchers_id;
	}
	
	public function getproject_id() {
		return $this->project_id;
	}
	
	public function setproject_id($project_id) {
		return $this->project_id=$project_id;
	}
	
	public function getvouchers_name() {
		return $this->vouchers_name;
	}
	
	public function setvouchers_name($vouchers_name) {
		return $this->vouchers_name=$vouchers_name;
	}
	
	public function getvouchers_type() {
		return $this->vouchers_type;
	}
	
	public function setvouchers_type($vouchers_type) {
		return $this->vouchers_type=$vouchers_type;
	}
	
	public function getvouchers_pic() {
		return $this->vouchers_pic;
	}
	
	public function setvouchers_pic($vouchers_pic) {
		return $this->vouchers_pic=$vouchers_pic;
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
	
}

?>
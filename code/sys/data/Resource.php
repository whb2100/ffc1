<?php
namespace sys\data;

use dao\Table;

class Resource extends Table {

	public $tableName = 'T_SYS_RESOURCE';
	public $tableView = 'V_SYS_RESOURCE';
	public $primaryKey = 'resource_id';
	public $sequenceName = 'S_T_SYS_RESOURCE';

	protected $resource_id;
	protected $resource_name;
	protected $resource_url;
	protected $resource_status;
	protected $resource_type;
	protected $resource_desc;
	protected $create_date;
	protected $create_by;
	protected $create_name;
	protected $resourceparent_id;
	protected $parent_name;
	
	public static $tablefields = array(
		'resource_id',
		'resource_name',
		'resource_url',
		'resource_status',
		'resource_type',
		'resource_desc',
		'create_date',
		'create_by',
		'create_name',
		'resourceparent_id',
		'parent_name',
	);
	
	public static $excelHeaderFields = array(
			'resource_name',
			'resource_url',
			'resource_type',
			'resource_status',
			'create_date',
			'parent_name',
			'create_name'
	);
	
	public function getresource_id() {
		return $this->resource_id;
	}
	
	public function setresource_id($resource_id) {
		return $this->resource_id=$resource_id;
	}
	
	public function getresource_name() {
		return $this->resource_name;
	}
	
	public function setresource_name($resource_name) {
		return $this->resource_name=$resource_name;
	}
	
	public function getresource_url() {
		return $this->resource_url;
	}
	
	public function setresource_url($resource_url) {
		return $this->resource_url=$resource_url;
	}
	
	public function getresource_status() {
		return $this->resource_status;
	}
	
	public function setresource_status($resource_status) {
		return $this->resource_status=$resource_status;
	}
	
	public function getresource_type() {
		return $this->resource_type;
	}
	
	public function setresource_type($resource_type) {
		return $this->resource_type=$resource_type;
	}
	
	public function getresource_desc() {
		return $this->resource_desc;
	}
	
	public function setresource_desc($resource_desc) {
		return $this->resource_desc=$resource_desc;
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
	
	public function getcreate_name() {
		return $this->create_name;
	}
	
	public function setcreate_name($create_name) {
		return $this->create_name=$create_name;
	}
	
	public function setcreate_by($create_by) {
		return $this->create_by=$create_by;
	}
	
	public function getresourceparent_id() {
		return $this->resourceparent_id;
	}
	
	public function setresourceparent_id($resourceparent_id) {
		return $this->resourceparent_id=$resourceparent_id;
	}
	
	public function getparent_name() {
		return $this->parent_name;
	}
	
	public function setparent_name($parent_name) {
		return $this->parent_name=$parent_name;
	}
	
	public static $statu = array(
			'0' => '不可用',
			'1' => '正常',
	);
	
	public static $type = array(
			'1' => '菜单资源',
			'2' => '按钮资源',
			'3' => '公共资源',
	);
	
	public function formatterObjByExcel($objArr){
		foreach ($objArr as $key => $value){
			if($value === null){
				$objArr[$key] = '';
			}
			switch ($key) {
	
				case 'resource_status':
					foreach (self::$statu as $statu_key => $statu_value){
						if($value == $statu_key){
							$objArr['resource_status'] = $statu_value;
						}
					}
					break;
					
				case 'resource_type':
					foreach (self::$type as $type_key => $type_value){
						if($value == $type_key){
							$objArr['resource_type'] = $type_value;
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
<?php
namespace dao;
class Table{
	
	public $rows = 20;
	
	public $page = 1;
	
	public function __call($method, $args) {
		if (preg_match('/^(get|set)(\w+)/', strtolower($method), $match)
				&& $attribute = $this->validateAttribute($match[2])) {
					if ('get' == $match[1]) {
						return $this->$attribute;
					} else {
						$this->$attribute = $args[0];
					}
				}else {
						var_dump('Call to undefined method ' . __CLASS__  . '::'.$method.'()');
				}
	}

	protected function validateAttribute($method) {
		if ( in_array(strtolower($method), array_keys(get_class_vars(get_class($this))))) {
			return strtolower($method);
		}

	}
	
	//页面展示时 对数据进行formatter
	public function formatterObj($objArr){
		return $objArr;
	}
	
	//excel导出时 对数据进行formatter
	public function formatterObjByExcel($objArr){
		return $objArr;
	}
	
	
}
?>
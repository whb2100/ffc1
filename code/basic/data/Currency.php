<?php

namespace basic\data;

use dao\Table;

class Currency extends Table{
	public $tableName = 't_biz_project_currency';
    public $tableView = 'v_biz_project_currency';
    public $primaryKey = 'record_id';

	protected $record_id;
    protected $project_id;
    protected $currency_code_id;
    protected $currency_type_id;
    protected $currency_desc;
    protected $exchange_rate;
    protected $create_by;
    protected $create_date;
    protected $last_update_by;
    protected $last_update_date;
    protected $currency_code;
    protected $currency_code_desc;
    protected $currency_type;

    public static $tablefields = array(
        'record_id',
        'project_id',
        'currency_code_id',
        'currency_type_id',
        'currency_desc',
        'exchange_rate',
        'create_by',
        'create_date',
        'last_update_by',
        'last_update_date',
        'currency_code',
        'currency_code_desc',
        'currency_type',
    );
    
    public static $excelHeaderFields = array(
    		'currency_code',
    		'currency_type',
    		'exchange_rate',
    		'currency_desc'
    );
    
    public static $code = array(
    		'00' => '00（主货币）'
    );
    
    public function formatterObjByExcel($objArr){
    	foreach ($objArr as $key => $value){
    		if($value === null){
    			$objArr[$key] = '';
    		}
    		switch ($key) {
    
    			case 'currency_code':
    				foreach (self::$code as $statu_key => $statu_value){
    					if($value == $statu_key){
    						$objArr['currency_code'] = $statu_value;
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

    public function getRecord_id() {
        return $this->record_id;
    }

    public function setRecord_id($record_id) {
        return $this->record_id = $record_id;
    }

    public function getProject_id() {
        return $this->project_id;
    }

    public function setProject_id($project_id) {
        return $this->project_id = $project_id;
    }

    public function getCurrency_code_id() {
        return $this->currency_code_id;
    }

    public function setCurrency_code_id($currency_code_id) {
        return $this->currency_code_id = $currency_code_id;
    }

    public function getCurrency_type_id() {
        return $this->currency_type_id;
    }

    public function setCurrency_type_id($currency_type_id) {
        return $this->currency_type_id = $currency_type_id;
    }

    public function getCurrency_desc() {
        return $this->currency_desc;
    }

    public function setCurrency_desc($currency_desc) {
        return $this->currency_desc = $currency_desc;
    }

    public function getExchange_rate() {
        return $this->exchange_rate;
    }

    public function setExchange_rate($exchange_rate) {
        return $this->exchange_rate = $exchange_rate;
    }

    public function getCreate_by() {
        return $this->create_by;
    }

    public function setCreate_by($create_by) {
        return $this->create_by = $create_by;
    }

    public function getCreate_date() {
        return $this->create_date;
    }

    public function setCreate_date($create_date) {
        return $this->create_date = $create_date;
    }

    public function getLast_update_by() {
        return $this->last_update_by;
    }

    public function setLast_update_by($last_update_by) {
        return $this->last_update_by = $last_update_by;
    }

    public function getLast_update_date() {
        return $this->last_update_date;
    }

    public function setLast_update_date($last_update_date) {
        return $this->last_update_date = $last_update_date;
    }

    public function getCurrency_code() {
        return $this->currency_code;
    }

    public function setCurrency_code($currency_code) {
        return $this->currency_code = $currency_code;
    }

    public function getCurrency_code_desc() {
        return $this->currency_code_desc;
    }

    public function setCurrency_code_desc($currency_code_desc) {
        return $this->currency_code_desc = $currency_code_desc;
    }

    public function getCurrency_type() {
        return $this->currency_type;
    }

    public function setCurrency_type($currency_type) {
        return $this->currency_type = $currency_type;
    }
    
	
}

?>
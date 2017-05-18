<?php

namespace report\data;

use dao\Table;

class Report extends Table{
	public $tableName = 't_biz_project_code';
    public $tableView = 'v_biz_project_code';
    public $primaryKey = 'record_id';

    protected $record_id;
    protected $project_id;
    protected $main_code;
    protected $sub_code;
    protected $code_desc_zh;
    protected $code_desc_en;
    protected $code_type;
    protected $amount;
    protected $statistics_level_id;
    protected $create_by;
    protected $create_date;
    protected $last_update_by;
    protected $last_update_date;
    protected $statistics_level_code;
    protected $last_amount;

    public static $tablefields = array(
        'record_id',
        'project_id',
        'main_code',
        'sub_code',
        'code_desc_zh',
        'code_desc_en',
        'code_type',
        'amount',
        'statistics_level_id',
        'create_by',
        'create_date',
        'last_update_by',
        'last_update_date',
        'statistics_level_code',
        'last_amount',
    );

    public static $excelModelFields = array(
            'main_code',
            'sub_code',
            'code_desc_zh',
            'code_desc_en',
            'amount',
            'statistics_level_id'
    );
          public static $excelModelFields_bud = array(
            'main_code',
            'sub_code',
            'code_desc_zh',
            'code_desc_en',
            'amount',
            'statistics_level_id',
    );
           public static $excelModelFields_etc = array(
            'main_code',
            'sub_code',
            'code_desc_zh',
            'code_desc_en',
            'last_amount',
            'statistics_level_id',
    );
       public static $level = array(
       		'1' => 'LEVEL 1',
       		'2' => 'LEVEL 2',
       		'3' => 'LEVEL 3'
       );
       
       public function formatterObjByExcel($objArr){
       	foreach ($objArr as $key => $value){
       		if($value === null){
       			$objArr[$key] = '';
       		}
       		switch ($key) {
       
       			case 'statistics_level_id':
       				foreach (self::$level as $statu_key => $statu_value){
       					if($value == $statu_key){
       						$objArr['statistics_level_id'] = $statu_value;
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
       
    public function getLast_amount() {
        return $this->last_amount;
    }

    public function setLast_amount($last_amount) {
        return $this->last_amount = $last_amount;
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

    public function getMain_code() {
        return $this->main_code;
    }

    public function setMain_code($main_code) {
        return $this->main_code = $main_code;
    }

    public function getSub_code() {
        return $this->sub_code;
    }

    public function setSub_code($sub_code) {
        return $this->sub_code = $sub_code;
    }

    public function getCode_desc_zh() {
        return $this->code_desc_zh;
    }

    public function setCode_desc_zh($code_desc_zh) {
        return $this->code_desc_zh = $code_desc_zh;
    }

    public function getCode_desc_en() {
        return $this->code_desc_en;
    }

    public function setCode_desc_en($code_desc_en) {
        return $this->code_desc_en = $code_desc_en;
    }

    public function getCode_type() {
        return $this->code_type;
    }

    public function setCode_type($code_type) {
        return $this->code_type = $code_type;
    }

    public function getAmount() {
        return $this->amount;
    }

    public function setAmount($amount) {
        return $this->amount = $amount;
    }

    public function getStatistics_level_id() {
        return $this->statistics_level_id;
    }

    public function setStatistics_level_id($statistics_level_id) {
        return $this->statistics_level_id = $statistics_level_id;
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

    public function getStatistics_level_code() {
        return $this->statistics_level_code;
    }

    public function setStatistics_level_code($statistics_level_code) {
        return $this->statistics_level_code = $statistics_level_code;
    }
	
}

?>
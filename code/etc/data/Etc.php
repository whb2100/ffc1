<?php

namespace etc\data;

use dao\Table;

class Etc extends Table{
	public $tableName = 't_biz_project_etc_code';
    public $tableView = 't_biz_project_etc_code';
    public $primaryKey = 'record_id';

    protected $record_id;
    protected $project_id;
    protected $main_code;
    protected $sub_code;
    protected $code_desc_zh;
    protected $code_desc_en;
    protected $amount;
    protected $statistics_level_id;
    protected $create_by;
    protected $create_date;
    protected $last_update_by;
    protected $last_update_date;

    public static $tablefields = array(
        'record_id',
        'project_id',
        'main_code',
        'sub_code',
        'code_desc_zh',
        'code_desc_en',
        'amount',
        'statistics_level_id',
        'create_by',
        'create_date',
        'last_update_by',
        'last_update_date',
    );
    
    public static $excelModelFields = array(
    		'main_code',
    		'sub_code',
    		'code_desc_zh',
    		'code_desc_en',
    		'amount',
    		'statistics_level_id'
    );

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

}
?>
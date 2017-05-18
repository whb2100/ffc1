<?php

namespace basic\data;

use dao\Table;

class Region extends Table{
	public $tableName = 't_biz_project_region';
    public $tableView = 't_biz_project_region';
    public $primaryKey = 'record_id';

    protected $record_id;
    protected $project_id;
    protected $region_code;
    protected $region_name;
    protected $create_by;
    protected $create_date;
    protected $last_update_by;
    protected $last_update_date;

    public static $tablefields = array(
        'record_id',
        'project_id',
        'region_code',
        'region_name',
        'create_by',
        'create_date',
        'last_update_by',
        'last_update_date',
    );
    
    public static $excelHeaderFields = array(
    		'region_code',
    		'region_name'
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

    public function getRegion_code() {
        return $this->region_code;
    }

    public function setRegion_code($region_code) {
        return $this->region_code = $region_code;
    }

    public function getRegion_name() {
        return $this->region_name;
    }

    public function setRegion_name($region_name) {
        return $this->region_name = $region_name;
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
<?php

namespace basic\data;

use dao\Table;

class Free extends Table{
	public $tableName = 't_biz_project_free';
    public $tableView = 't_biz_project_free';
    public $primaryKey = 'record_id';

    protected $record_id;
    protected $project_id;
    protected $free_code;
    protected $free_desc;
    protected $free_type;
    protected $create_by;
    protected $create_date;
    protected $last_update_by;
    protected $last_update_date;

    public static $tablefields = array(
        'record_id',
        'project_id',
        'free_code',
        'free_desc',
        'free_type',
        'create_by',
        'create_date',
        'last_update_by',
        'last_update_date',
    );
    
    public static $excelHeaderFields = array(
    		'free_code',
    		'free_desc'
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

    public function getFree_code() {
        return $this->free_code;
    }

    public function setFree_code($free_code) {
        return $this->free_code = $free_code;
    }

    public function getFree_desc() {
        return $this->free_desc;
    }

    public function setFree_desc($free_desc) {
        return $this->free_desc = $free_desc;
    }

    public function getFree_type() {
        return $this->free_type;
    }

    public function setFree_type($free_type) {
        return $this->free_type = $free_type;
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
<?php

namespace basic\data;

use dao\Table;

class Scene extends Table{
	public $tableName = 't_biz_project_scene';
    public $tableView = 't_biz_project_scene';
    public $primaryKey = 'record_id';

    protected $record_id;
    protected $project_id;
    protected $scene_code;
    protected $scene_desc;
    protected $create_by;
    protected $create_date;
    protected $last_update_by;
    protected $last_update_date;

    public static $tablefields = array(
        'record_id',
        'project_id',
        'scene_code',
        'scene_desc',
        'create_by',
        'create_date',
        'last_update_by',
        'last_update_date',
    );
    
    public static $excelHeaderFields = array(
    		'scene_code',
    		'scene_desc'
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

    public function getScene_code() {
        return $this->scene_code;
    }

    public function setScene_code($scene_code) {
        return $this->scene_code = $scene_code;
    }

    public function getScene_desc() {
        return $this->scene_desc;
    }

    public function setScene_desc($scene_desc) {
        return $this->scene_desc = $scene_desc;
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
<?php

namespace batch\data;

use dao\Table;

class Batch extends Table{
	public $tableName = 't_biz_batch_info';
    public $tableView = 'v_biz_batch_info';
    public $primaryKey = 'batch_id';

    protected $batch_id;
    protected $batch_code;
    protected $project_id;
    protected $currency_id;
    protected $status;
    protected $create_date;
    protected $create_by;
    protected $last_update_date;
    protected $last_update_by;
    protected $currency_code;
    protected $currency_desc;
    protected $currency_type;

    public static $tablefields = array(
        'batch_id',
        'batch_code',
        'project_id',
        'currency_id',
        'status',
        'create_date',
        'create_by',
        'last_update_date',
        'last_update_by',
        'currency_code',
        'currency_desc',
        'currency_type',
    );

    public function getBatch_id() {
        return $this->batch_id;
    }

    public function setBatch_id($batch_id) {
        return $this->batch_id = $batch_id;
    }

    public function getBatch_code() {
        return $this->batch_code;
    }

    public function setBatch_code($batch_code) {
        return $this->batch_code = $batch_code;
    }

    public function getProject_id() {
        return $this->project_id;
    }

    public function setProject_id($project_id) {
        return $this->project_id = $project_id;
    }

    public function getCurrency_id() {
        return $this->currency_id;
    }

    public function setCurrency_id($currency_id) {
        return $this->currency_id = $currency_id;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        return $this->status = $status;
    }

    public function getCreate_date() {
        return $this->create_date;
    }

    public function setCreate_date($create_date) {
        return $this->create_date = $create_date;
    }

    public function getCreate_by() {
        return $this->create_by;
    }

    public function setCreate_by($create_by) {
        return $this->create_by = $create_by;
    }

    public function getLast_update_date() {
        return $this->last_update_date;
    }

    public function setLast_update_date($last_update_date) {
        return $this->last_update_date = $last_update_date;
    }

    public function getLast_update_by() {
        return $this->last_update_by;
    }

    public function setLast_update_by($last_update_by) {
        return $this->last_update_by = $last_update_by;
    }

    public function getCurrency_code() {
        return $this->currency_code;
    }

    public function setCurrency_code($currency_code) {
        return $this->currency_code = $currency_code;
    }

    public function getCurrency_desc() {
        return $this->currency_desc;
    }

    public function setCurrency_desc($currency_desc) {
        return $this->currency_desc = $currency_desc;
    }

    public function getCurrency_type() {
        return $this->currency_type;
    }

    public function setCurrency_type($currency_type) {
        return $this->currency_type = $currency_type;
    }
	
}

?>
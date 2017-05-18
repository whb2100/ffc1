<?php

namespace project\data;

use dao\Table;

class User extends Table {
	
    public $tableName = 'T_SYS_USER';
    public $tableView = 'v_sys_user';
    public $primaryKey = 'user_id';

    protected $user_id;
    protected $project_id;
    protected $user_empcode;
    protected $user_password;
    protected $user_realname;
    protected $user_status;
    protected $position_id;
    protected $create_date;
    protected $create_by;
    protected $last_update_date;
    protected $last_update_by;
    protected $user_status_name;
    protected $position_name;

    public static $tablefields = array(
        'user_id',
        'project_id',
        'user_empcode',
        'user_password',
        'user_realname',
        'user_status',
        'position_id',
        'create_date',
        'create_by',
        'last_update_date',
        'last_update_by',
        'user_status_name',
        'position_name',
    );
    public static $excelHeaderFields = array(
        'user_empcode',
        'position_name',
        'user_status_name',
        'user_realname',
        'create_date'
    );

    public function getUser_id() {
        return $this->user_id;
    }

    public function setUser_id($user_id) {
        return $this->user_id = $user_id;
    }

    public function getProject_id() {
        return $this->project_id;
    }

    public function setProject_id($project_id) {
        return $this->project_id = $project_id;
    }

    public function getUser_empcode() {
        return $this->user_empcode;
    }

    public function setUser_empcode($user_empcode) {
        return $this->user_empcode = $user_empcode;
    }

    public function getUser_password() {
        return $this->user_password;
    }

    public function setUser_password($user_password) {
        return $this->user_password = $user_password;
    }

    public function getUser_realname() {
        return $this->user_realname;
    }

    public function setUser_realname($user_realname) {
        return $this->user_realname = $user_realname;
    }

    public function getUser_status() {
        return $this->user_status;
    }

    public function setUser_status($user_status) {
        return $this->user_status = $user_status;
    }

    public function getPosition_id() {
        return $this->position_id;
    }

    public function setPosition_id($position_id) {
        return $this->position_id = $position_id;
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

    public function getUser_status_name() {
        return $this->user_status_name;
    }

    public function setUser_status_name($user_status_name) {
        return $this->user_status_name = $user_status_name;
    }

    public function getPosition_name() {
        return $this->position_name;
    }

    public function setPosition_name($position_name) {
        return $this->position_name = $position_name;
    }

}
?>










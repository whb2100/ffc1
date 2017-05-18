<?php
namespace sys\data;

use dao\Table;

class Department extends Table {

public $tableName = 'T_SYS_DEPARTMENT';
    public $tableView = 'V_SYS_DEPARTMENT';
    public $primaryKey = 'dept_id';
    //public $sequenceName = 'S_T_SYS_DEPARTMENT';

    protected $dept_code;
    protected $dept_id;
    protected $dept_name;
    protected $parent_code;
    protected $parent_id;
    protected $parent_name;

    public static $tablefields = array(
        'dept_code',
        'dept_id',
        'dept_name',
        'parent_code',
        'parent_id',
        'parent_name',
    );
    public function getdept_code() {
        return $this->dept_code;
    }

    public function setdept_code($dept_code) {
        return $this->dept_code = $dept_code;
    }

    public function getdept_id() {
        return $this->dept_id;
    }

    public function setdept_id($dept_id) {
        return $this->dept_id = $dept_id;
    }

    public function getdept_name() {
        return $this->dept_name;
    }

    public function setdept_name($dept_name) {
        return $this->dept_name = $dept_name;
    }

    public function getparent_code() {
        return $this->parent_code;
    }

    public function setparent_code($parent_code) {
        return $this->parent_code = $parent_code;
    }

    public function getparent_id() {
        return $this->parent_id;
    }

    public function setparent_id($parent_id) {
        return $this->parent_id = $parent_id;
    }

    public function getparent_name() {
        return $this->parent_name;
    }

    public function setparent_name($parent_name) {
        return $this->parent_name = $parent_name;
    }

}
?>
<?php

namespace project\data;

use dao\Table;

class Company extends Table {
    
    public $tableName = 't_biz_project_company';
    public $tableView = 't_biz_project_company';
    public $primaryKey = 'company_id';

    protected $company_id;
    protected $project_id;
    protected $company_name;

    public static $tablefields = array(
        'company_id',
        'project_id',
        'company_name',
    );

    public function getCompany_id() {
        return $this->company_id;
    }

    public function setCompany_id($company_id) {
        return $this->company_id = $company_id;
    }

    public function getProject_id() {
        return $this->project_id;
    }

    public function setProject_id($project_id) {
        return $this->project_id = $project_id;
    }

    public function getCompany_name() {
        return $this->company_name;
    }

    public function setCompany_name($company_name) {
        return $this->company_name = $company_name;
    }

}


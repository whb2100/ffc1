<?php

namespace project\data;

use dao\Table;

class Director extends Table {
    
    public $tableName = 't_biz_project_director';
    public $tableView = 't_biz_project_director';
    public $primaryKey = 'director_id';


    protected $director_id;
    protected $project_id;
    protected $director_name;

    public static $tablefields = array(
        'director_id',
        'project_id',
        'director_name',
    );

    public function getDirector_id() {
        return $this->director_id;
    }

    public function setDirector_id($director_id) {
        return $this->director_id = $director_id;
    }

    public function getProject_id() {
        return $this->project_id;
    }

    public function setProject_id($project_id) {
        return $this->project_id = $project_id;
    }

    public function getDirector_name() {
        return $this->director_name;
    }

    public function setDirector_name($director_name) {
        return $this->director_name = $director_name;
    }

}
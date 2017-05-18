<?php

namespace project\data;

use dao\Table;

class Actor extends Table {
    
    public $tableName = 't_biz_project_main_actor';
    public $tableView = 't_biz_project_main_actor';
    public $primaryKey = 'actor_id';


    protected $actor_id;
    protected $project_id;
    protected $actor_name;

    public static $tablefields = array(
        'actor_id',
        'project_id',
        'actor_name',
    );

    public function getActor_id() {
        return $this->actor_id;
    }

    public function setActor_id($actor_id) {
        return $this->actor_id = $actor_id;
    }

    public function getProject_id() {
        return $this->project_id;
    }

    public function setProject_id($project_id) {
        return $this->project_id = $project_id;
    }

    public function getActor_name() {
        return $this->actor_name;
    }

    public function setActor_name($actor_name) {
        return $this->actor_name = $actor_name;
    }

}
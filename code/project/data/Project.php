<?php

namespace project\data;

use dao\Table;

class Project extends Table {
	
    public $tableName = 'T_BIZ_PROJECT_INFO';
    public $tableView = 'V_BIZ_PROJECT_INFO';
    public $primaryKey = 'project_id';

    protected $project_id;
    protected $project_code;
    protected $project_name;
    protected $project_status;
    protected $create_date;
    protected $create_by;
    protected $last_update_date;
    protected $last_update_by;
    protected $project_status_name;
    protected $project_status_name_en;

     public static $tablefields = array(
        'project_id',
        'project_code',
        'project_name',
        'project_status',
        'create_date',
        'create_by',
        'last_update_date',
        'last_update_by',
        'project_status_name',
        'project_status_name_en'
    );
    
    public static $excelHeaderFields = array(
        'project_code',
        'project_name',
        'project_status_name',
        'create_date'
    );


    public function getProject_id() {
        return $this->project_id;
    }

    public function setProject_id($project_id) {
        return $this->project_id = $project_id;
    }

    public function getProject_code() {
        return $this->project_code;
    }

    public function setProject_code($project_code) {
        return $this->project_code = $project_code;
    }

    public function getProject_name() {
        return $this->project_name;
    }

    public function setProject_name($project_name) {
        return $this->project_name = $project_name;
    }

    public function getProject_status() {
        return $this->project_status;
    }

    public function setProject_status($project_status) {
        return $this->project_status = $project_status;
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

    public function getProject_status_name() {
        return $this->project_status_name;
    }

    public function setProject_status_name($project_status_name) {
        return $this->project_status_name = $project_status_name;
    }
    public function getProject_status_name_en() {
        return $this->project_status_name_en;
    }

    public function setProject_status_name_en($project_status_name_en) {
        return $this->project_status_name_en = $project_status_name_en;
    }
public function formatterObjByExcel($objArr){
        foreach ($objArr as $key => $value){
            if($value === null){
                $objArr[$key] = '';
            }
            // switch ($key) {
            //     case 'project_code':
                    
            //          $obj['project_code'] =  $objArr[$key];
                    
            //         break;
            //     case 'project_name':
            //                   $obj['project_name'] =  $objArr[$key];
            //                 break;

            // case 'project_status_name':
            //                       $obj['project_status_name'] =  $objArr[$key];
            //                     break;
            //     case 'create_date':
            //                   $obj['create_date'] =  $objArr[$key];
            //                 break;
                            
            //             default:
            //                 ;
            //                 break;
            // }
        }
        return $obj;
    }

	
}

?>
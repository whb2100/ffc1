<?php

namespace poInput\data;

use dao\Table;

class BatchCode extends Table{
	public $tableName = 'v_biz_po_main_sub_code';
    public $tableView = 'v_biz_po_main_sub_code';
    public $primaryKey = 'batch_id';

    protected $batch_id;
    protected $main_code;
    protected $sub_code;
    protected $code_desc_zh;
    protected $code_desc_en;

    public static $tablefields = array(
        'batch_id',
        'main_code',
        'sub_code',
        'code_desc_zh',
        'code_desc_en',
    );

    public function getBatch_id() {
        return $this->batch_id;
    }

    public function setBatch_id($batch_id) {
        return $this->batch_id = $batch_id;
    }

    public function getMain_code() {
        return $this->main_code;
    }

    public function setMain_code($main_code) {
        return $this->main_code = $main_code;
    }

    public function getSub_code() {
        return $this->sub_code;
    }

    public function setSub_code($sub_code) {
        return $this->sub_code = $sub_code;
    }

    public function getCode_desc_zh() {
        return $this->code_desc_zh;
    }

    public function setCode_desc_zh($code_desc_zh) {
        return $this->code_desc_zh = $code_desc_zh;
    }

    public function getCode_desc_en() {
        return $this->code_desc_en;
    }

    public function setCode_desc_en($code_desc_en) {
        return $this->code_desc_en = $code_desc_en;
    }
	
}

?>
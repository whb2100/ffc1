<?php

namespace poInput\data;

use dao\Table;

class TransactionCode extends Table{
	public $tableName = 'v_biz_po_check_transaction_code';
    public $tableView = 'v_biz_po_check_transaction_code';
    public $primaryKey = 'all_code';

	protected $all_code;
    protected $code_desc_zh;
    protected $code_desc_en;
    protected $transaction_code;
    protected $total_amount;
    protected $detail_id;
    protected $transaction_id;
    protected $project_region_id;
    protected $project_code_id;
    protected $project_scene_id;
    protected $project_free1_id;
    protected $project_free2_id;
    protected $project_free3_id;
    protected $amount;
    protected $detail_desc;
    protected $create_date;
    protected $create_by;
    protected $last_update_date;
    protected $last_update_by;
    protected $is_asset;

    public static $tablefields = array(
        'all_code',
        'code_desc_zh',
        'code_desc_en',
        'transaction_code',
        'total_amount',
        'detail_id',
        'transaction_id',
        'project_region_id',
        'project_code_id',
        'project_scene_id',
        'project_free1_id',
        'project_free2_id',
        'project_free3_id',
        'amount',
        'detail_desc',
        'create_date',
        'create_by',
        'last_update_date',
        'last_update_by',
    	'is_asset'
    );
    
    public static $excelHeaderFields = array(
    		'all_code',
    		'is_asset',
    		'detail_desc',
    		'amount'
    );
    
    public static $asset = array(
    		'1' => '资产',
    		'0' => '非资产'
    );
    
    public static $asset_en = array(
    		'1' => 'Assets',
    		'0' => 'Non assets'
    );
    
    public function formatterObjByExcel($objArr){
    	foreach ($objArr as $key => $value){
    		if($value === null){
    			$objArr[$key] = '';
    		}
    		switch ($key) {
    
    			case 'is_asset':
    				foreach (self::$asset as $statu_key => $statu_value){
    					if($value == $statu_key){
    						$objArr['is_asset'] = $statu_value;
    					}
    				}
    				break;
    
    			case 'amount':
    				if(is_float($objArr['amount'])){
    					$objArr['amount'] = number_format($objArr['amount']);
    				}else{
    					$objArr['amount'] = number_format($objArr['amount']).".00";
    				}
    				break;
    
    			default:
    				;
    				break;
    		}
    	}
    	return $objArr;
    }
    
    public function formatterObjByExcelEn($objArr){
    	foreach ($objArr as $key => $value){
    		if($value === null){
    			$objArr[$key] = '';
    		}
    		switch ($key) {
    
    			case 'is_asset':
    				foreach (self::$asset_en as $statu_key => $statu_value){
    					if($value == $statu_key){
    						$objArr['is_asset'] = $statu_value;
    					}
    				}
    				break;
    
    			case 'amount':
    				if(is_float($objArr['amount'])){
    					$objArr['amount'] = number_format($objArr['amount']);
    				}else{
    					$objArr['amount'] = number_format($objArr['amount']).".00";
    				}
    				break;
    
    			default:
    				;
    				break;
    		}
    	}
    	return $objArr;
    }

    public function getAll_code() {
        return $this->all_code;
    }

    public function setAll_code($all_code) {
        return $this->all_code = $all_code;
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

    public function getTransaction_code() {
        return $this->transaction_code;
    }

    public function setTransaction_code($transaction_code) {
        return $this->transaction_code = $transaction_code;
    }

    public function getTotal_amount() {
        return $this->total_amount;
    }

    public function setTotal_amount($total_amount) {
        return $this->total_amount = $total_amount;
    }

    public function getDetail_id() {
        return $this->detail_id;
    }

    public function setDetail_id($detail_id) {
        return $this->detail_id = $detail_id;
    }

    public function getTransaction_id() {
        return $this->transaction_id;
    }

    public function setTransaction_id($transaction_id) {
        return $this->transaction_id = $transaction_id;
    }

    public function getProject_region_id() {
        return $this->project_region_id;
    }

    public function setProject_region_id($project_region_id) {
        return $this->project_region_id = $project_region_id;
    }

    public function getProject_code_id() {
        return $this->project_code_id;
    }

    public function setProject_code_id($project_code_id) {
        return $this->project_code_id = $project_code_id;
    }

    public function getProject_scene_id() {
        return $this->project_scene_id;
    }

    public function setProject_scene_id($project_scene_id) {
        return $this->project_scene_id = $project_scene_id;
    }

    public function getProject_free1_id() {
        return $this->project_free1_id;
    }

    public function setProject_free1_id($project_free1_id) {
        return $this->project_free1_id = $project_free1_id;
    }

    public function getProject_free2_id() {
        return $this->project_free2_id;
    }

    public function setProject_free2_id($project_free2_id) {
        return $this->project_free2_id = $project_free2_id;
    }

    public function getProject_free3_id() {
        return $this->project_free3_id;
    }

    public function setProject_free3_id($project_free3_id) {
        return $this->project_free3_id = $project_free3_id;
    }

    public function getAmount() {
        return $this->amount;
    }

    public function setAmount($amount) {
        return $this->amount = $amount;
    }

    public function getDetail_desc() {
        return $this->detail_desc;
    }

    public function setDetail_desc($detail_desc) {
        return $this->detail_desc = $detail_desc;
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
    
    public function getIs_asset() {
    	return $this->is_asset;
    }
    
    public function setIs_asset($is_asset) {
    	return $this->is_asset = $is_asset;
    }
	
}

?>
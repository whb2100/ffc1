<?php

namespace batch\data;

use dao\Table;

class TransactionDetail extends Table{
	public $tableName = 't_biz_transaction_detail';
    public $tableView = 'v_biz_batch_check_transaction_detial';
    public $primaryKey = 'detail_id';

    protected $all_code;
    protected $batch_id;
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
    protected $currency_code;
    protected $main_code;
    protected $sub_code;
    protected $region_code;
    protected $scene_code;
    protected $free_code1;
    protected $free_code2;
    protected $free_code3;
    protected $detail_record_date;
    protected $status;
    protected $project_id;
    protected $exchange_rate;
    protected $batch_code;
    protected $new_amount;
    protected $main_sub_code;

    public static $tablefields = array(
        'all_code',
        'batch_id',
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
        'is_asset',
        'currency_code',
        'main_code',
        'sub_code',
        'region_code',
        'scene_code',
        'free_code1',
        'free_code2',
        'free_code3',
    	'detail_record_date',
    	'status',
    	'project_id',
    	'exchange_rate',
    	'batch_code',
    	'new_amount',
    	'main_sub_code'
    );
    
    public static $excelHeaderFields = array(
    		'all_code',
    		'is_asset',
    		'transaction_code',
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
    					$objArr['amount'] = number_format($objArr['amount'],2);
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

    public function getBatch_id() {
        return $this->batch_id;
    }

    public function setBatch_id($batch_id) {
        return $this->batch_id = $batch_id;
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

    public function getCurrency_code() {
        return $this->currency_code;
    }

    public function setCurrency_code($currency_code) {
        return $this->currency_code = $currency_code;
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

    public function getRegion_code() {
        return $this->region_code;
    }

    public function setRegion_code($region_code) {
        return $this->region_code = $region_code;
    }

    public function getScene_code() {
        return $this->scene_code;
    }

    public function setScene_code($scene_code) {
        return $this->scene_code = $scene_code;
    }

    public function getFree_code1() {
        return $this->free_code1;
    }

    public function setFree_code1($free_code1) {
        return $this->free_code1 = $free_code1;
    }

    public function getFree_code2() {
        return $this->free_code2;
    }

    public function setFree_code2($free_code2) {
        return $this->free_code2 = $free_code2;
    }

    public function getFree_code3() {
        return $this->free_code3;
    }

    public function setFree_code3($free_code3) {
        return $this->free_code3 = $free_code3;
    }
    
    public function getDetail_record_date() {
    	return $this->detail_record_date;
    }
    
    public function setDetail_record_date($detail_record_date) {
    	return $this->detail_record_date = $detail_record_date;
    }
    
    public function getStatus() {
    	return $this->status;
    }
    
    public function setStatus($status) {
    	return $this->status = $status;
    }
    
    public function getProject_id() {
    	return $this->project_id;
    }
    
    public function setProject_id($project_id) {
    	return $this->project_id = $project_id;
    }
    
    public function getExchange_rate() {
    	return $this->exchange_rate;
    }
    
    public function setExchange_rate($exchange_rate) {
    	return $this->exchange_rate = $exchange_rate;
    }
    
    public function getBatch_code() {
    	return $this->batch_code;
    }
    
    public function setBatch_code($batch_code) {
    	return $this->batch_code = $batch_code;
    }
    
    public function getNew_amount() {
    	return $this->new_amount;
    }
    
    public function setNew_amount($new_amount) {
    	return $this->new_amount = $new_amount;
    }
    
}

?>
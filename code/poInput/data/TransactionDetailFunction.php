<?php

namespace poInput\data;

use utils\ObjectUtils;
use utils\ReturnResult;
use dao\Db;
use common\Constants;
use utils\ExcelUtils;

class TransactionDetailFunction {
	
	public static function retrieveitem($paramArr){
		$arr = array();
		$itemMapper = new TransactionDetailMapper();
		$item = new TransactionDetail();
		$where = " where 1=1 ";
		$batchId = trim($paramArr['batch_ids']);
		$mainCode = trim($paramArr['main_codes']);
		$subCode = trim($paramArr['sub_codes']);
		if($batchId != null && $batchId != ""){
			$where.= " and batch_id = $batchId";
		}
		if($mainCode != null && $mainCode != ""){
			$where.= " and main_code = '$mainCode'";
		}
		if($subCode != null && $subCode != ""){
			$where.= " and sub_code = '$subCode'";
		}
		$item = ObjectUtils::arrToObj($paramArr, $item);
		$arr = $itemMapper->find($item,$where);
		return $arr;
	}
	
	public static function createitem($paramArr){
		$arr = array();
		$itemMapper = new TransactionDetailMapper();
		$item = new TransactionDetail();
		$item = ObjectUtils::arrToObj($paramArr, $item);
		$item->setcreate_date(date('Y-m-d H:i:s', time()));
		$item->setcreate_by($_SESSION[Constants::LOGINED_USER_ID_IN_SESSION]);
		$item->setlast_update_date(date('Y-m-d H:i:s', time()));
		$item->setlast_update_by($_SESSION[Constants::LOGINED_USER_ID_IN_SESSION]);
		$res = $itemMapper->save($item);
		$arr = ReturnResult::returnMsg($res);
		return $arr;
	}
	
	public static function updateitem($paramArr){
		$arr = array();
		$itemMapper = new SceneMapper();
		$item = new Scene();
		$item = ObjectUtils::arrToObj($paramArr, $item);
		$item->setlast_update_date(date('Y-m-d H:i:s', time()));
		$item->setlast_update_by($_SESSION[Constants::LOGINED_USER_ID_IN_SESSION]);
		$res = $itemMapper->update($item);
		$arr = ReturnResult::returnMsg($res);
		return $arr;
	}
	
	public static function itemNameCheck($paramArr){
		$arr = array();
		$itemMapper = new TransactionMapper();
		$item = new Transaction();
		$value = trim($paramArr['transaction_codes']);
		$where = " where transaction_code ='$value'";
// 		$item = ObjectUtils::arrToObj($paramArr, $item);
		$res = $itemMapper->find($item,$where);
		if(empty($res)){
			$arr['result'] = Constants::RESULT_CODE_SUCCESS;
			$arr['msg'] = Constants::OPERATION_SUCCESS;
		}else{
			if($res['total']>0){
				$arr['result'] = Constants::RESULT_CODE_FAIL_REPEAT;
				$arr['msg'] = Constants::EXIST_SAME_NAME;
			}else{
				$arr['result'] = Constants::RESULT_CODE_SUCCESS;
				$arr['msg'] = Constants::OPERATION_SUCCESS;
			}
		}
		return $arr;
	}
	
	//根据科目导出
	public static function exportSub($paramArr){
		$arr = array();
		$itemMapper = new TransactionDetailMapper();
		$item = new TransactionDetail();
		$where = " where 1=1";
		$BatchCodeData = BatchFunction::retrieveBatchCode($paramArr);
		$paramArr['page'] = 1;
		$paramArr['rows'] = PHP_INT_MAX;
		$dataArr = array();
		foreach ($BatchCodeData['rows'] as $value){
			$batchId = $value['batch_id'];
			$mainCode = $value['main_code'];
			$subCode = $value['sub_code'];
			$where = " where batch_id = $batchId and main_code = '$mainCode' and sub_code = '$subCode'";
			$dataArray =  $itemMapper->find($item, $where, '', TransactionDetail::$excelHeaderFields);
			$amount = 0;
			for($i=0; $i <count($dataArray['rows']) ; $i++){
				$amount += $dataArray['rows'][$i][amount];
			}
			if($paramArr['language'] == "en"){
				$dataArr['all_code'] = "Code：".$mainCode." ".$subCode." ".$value['code_desc_en'];
				$dataArr['is_asset'] = "";
				$dataArr['transaction_code'] = "";
				$dataArr['detail_desc'] = "";
				$dataArr['amount'] = "Total:".number_format($amount);
			}else{
				$dataArr['all_code'] = "编码：".$mainCode." ".$subCode." ".$value['code_desc_zh'];
				$dataArr['is_asset'] = "";
				$dataArr['transaction_code'] = "";
				$dataArr['detail_desc'] = "";
				$dataArr['amount'] = "合计：".number_format($amount);
			}
			$rs[] = $dataArr;
			for ($i=0; $i <count($dataArray['rows']) ; $i++) {
				if($paramArr['language'] == "en"){
					$rs[]=$item->formatterObjByExcelEn($dataArray['rows'][$i]);
				}else{
					$rs[]=$item->formatterObjByExcel($dataArray['rows'][$i]);
				}
			}
		}
		if($paramArr['language'] == "en"){
			$excel_name = ExcelUtils::createExcelByModel('poSub',BASE_DIR.'uploads/excelModel/poSub-en.xls', $rs);
		}else{
			$excel_name = ExcelUtils::createExcelByModel('poSub',BASE_DIR.'uploads/excelModel/poSub.xls', $rs);
		}
		$arr['result'] = Constants::RESULT_CODE_SUCCESS;
		$arr['msg'] = $excel_name;
		return $arr;
	}
	
	//查询PO明细报表
	public static function retrieveRecords($paramArr){
		$arr = array();
		$itemMapper = new TransactionDetailMapper();
		$item = new TransactionDetail();
		$where = " where 1=1 and status=2";
		$projectId = $_SESSION['hqinfo_qm_current_user_project_id_session'];
		$startDate = trim($paramArr['start_date']);
		$currencyCode = $paramArr['currency'];
		if ($projectId==null||$projectId=='') {
			return $item;
		}else{
			$where.= " and project_id = $projectId";
		}
		if($startDate != null && $startDate != ""){
			$where.= " and detail_record_date > '$startDate'";
		}
		if($currencyCode != null && $currencyCode != ""){
			$where.= " and currency_code = '$currencyCode'";
		}
		$item = ObjectUtils::arrToObj($paramArr, $item);
		$arr = $itemMapper->find($item,$where,'','','main_code,sub_code');
		return $arr;
	}
	
	public static function retrieveAllItem($paramArr){
		$arr = array();
		$itemMapper = new TransactionDetailMapper();
		$item = new TransactionDetail();
		$where = " where 1=1";
		$BatchCodeData = BatchFunction::retrieveBatchCode($paramArr);
		$paramArr['page'] = 1;
		$paramArr['rows'] = PHP_INT_MAX;
		$dataArr = array();
		foreach ($BatchCodeData['rows'] as $value) {
			$batchId = $value['batch_id'];
			$mainCode = $value['main_code'];
			$subCode = $value['sub_code'];
			$where = " where batch_id = $batchId and main_code = '$mainCode' and sub_code = '$subCode'";
			$dataArray = $itemMapper->find($item, $where, '', TransactionDetail::$excelHeaderFields);
			$amount = 0;
			for ($i = 0; $i < count($dataArray['rows']); $i++) {
				$amount += $dataArray['rows'][$i][amount];
			}
			if ($paramArr['language'] == "en") {
				$dataArr['all_code'] = "Code：".$mainCode." ".$subCode." ".$value['code_desc_en'];
				$dataArr['is_asset'] = "";
				$dataArr['transaction_code'] = "";
				$dataArr['detail_desc'] = "";
				$dataArr['amount'] = "Total:".number_format($amount);
			} else {
				$dataArr['all_code'] = "编码：".$mainCode." ".$subCode." ".$value['code_desc_zh'];
				$dataArr['is_asset'] = "";
				$dataArr['transaction_code'] = "";
				$dataArr['detail_desc'] = "";
				$dataArr['amount'] = "合计：".number_format($amount);
			}
			$rs[] = $dataArr;
			for ($i = 0; $i < count($dataArray['rows']); $i++) {
				if ($paramArr['language'] == "en") {
					$rs[] = $item->formatterObjByExcelEn($dataArray['rows'][$i]);
				} else {
					$rs[] = $item->formatterObjByExcel($dataArray['rows'][$i]);
				}
			}
		}
		return $rs;
	}
}
?>
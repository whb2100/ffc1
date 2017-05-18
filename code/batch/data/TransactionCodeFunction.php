<?php

namespace batch\data;

use utils\ObjectUtils;
use utils\ReturnResult;
use dao\Db;
use common\Constants;
use utils\ExcelUtils;

class TransactionCodeFunction {
	
	public static function retrieveitem($paramArr){
		$arr = array();
		$itemMapper = new TransactionCodeMapper();
		$item = new TransactionCode();
		$where = " where 1=1 ";
		$transactionId = trim($paramArr['transaction_ids']);
		if($transactionId != null && $transactionId != ""){
			$where.= " and transaction_id = $transactionId";
		}
		$item = ObjectUtils::arrToObj($paramArr, $item);
		$arr = $itemMapper->find($item,$where);
		return $arr;
	}
	
	//根据单号导出
	public static function exportNum($paramArr){
		$arr = array();
		$itemMapper = new TransactionCodeMapper();
		$item = new TransactionCode();
		$where = " where 1=1";
		$TransactionData = TransactionFunction::retrieveitem($paramArr);
		$paramArr['page'] = 1;
		$paramArr['rows'] = PHP_INT_MAX;
		$dataArr = array();
		foreach ($TransactionData['rows'] as $value){
			$transactionId = $value['transaction_id'];
			$where = " where transaction_id = $transactionId";
			$dataArray =  $itemMapper->find($item, $where, '', TransactionCode::$excelHeaderFields);
			if($paramArr['language'] == "en"){
				$dataArr['all_code'] = "Transaction number:".$value['transaction_code'];
				$dataArr['is_asset'] = "";
				$dataArr['detail_desc'] = "";
				$dataArr['amount'] = "Total:0.00";
			}else{
				$dataArr['all_code'] = "交易号：".$value['transaction_code'];
				$dataArr['is_asset'] = "";
				$dataArr['detail_desc'] = "";
				$dataArr['amount'] = "合计：0.00";
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
			$excel_name = ExcelUtils::createExcelByModel('batchNum',BASE_DIR.'uploads/excelModel/batchNum-en.xls', $rs);
		}else{
			$excel_name = ExcelUtils::createExcelByModel('batchNum',BASE_DIR.'uploads/excelModel/batchNum.xls', $rs);
		}
		$arr['result'] = Constants::RESULT_CODE_SUCCESS;
		$arr['msg'] = $excel_name;
		return $arr;
	}
	
	public static function retrieveAllItem($paramArr){
		$arr = array();
		$itemMapper = new TransactionCodeMapper();
		$item = new TransactionCode();
		$where = " where 1=1";
		$TransactionData = TransactionFunction::retrieveitem($paramArr);
		$paramArr['page'] = 1;
		$paramArr['rows'] = PHP_INT_MAX;
		$dataArr = array();
		foreach ($TransactionData['rows'] as $value){
			$transactionId = $value['transaction_id'];
			$where = " where transaction_id = $transactionId";
			$dataArray =  $itemMapper->find($item, $where, '', TransactionCode::$excelHeaderFields);
			if ($paramArr['language'] == "en") {
				$dataArr['all_code'] = "Transaction number:".$value['transaction_code'];
				$dataArr['is_asset'] = "";
				$dataArr['detail_desc'] = "";
				$dataArr['amount'] = "Total:0.00";
			} else {
				$dataArr['all_code'] = "交易号：".$value['transaction_code'];
				$dataArr['is_asset'] = "";
				$dataArr['detail_desc'] = "";
				$dataArr['amount'] = "合计：0.00";
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
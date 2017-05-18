<?php

namespace batch\data;

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
			$excel_name = ExcelUtils::createExcelByModel('batchSub',BASE_DIR.'uploads/excelModel/batchSub-en.xls', $rs);
		}else{
			$excel_name = ExcelUtils::createExcelByModel('batchSub',BASE_DIR.'uploads/excelModel/batchSub.xls', $rs);
		}
		$arr['result'] = Constants::RESULT_CODE_SUCCESS;
		$arr['msg'] = $excel_name;
		return $arr;
	}
	
	//查询批处理明细报表
	public static function retrieveRecords($paramArr){
		$arr = array();
		$itemMapper = new TransactionDetailMapper();
		$item = new TransactionDetail();
		$where = " where 1=1 and status=2";
		$projectId = $_SESSION['hqinfo_qm_current_user_project_id_session'];
		$currencyStart = trim($paramArr['currency_start']);
		$currencyEnd = trim($paramArr['currency_end']);
		$regionStart = trim($paramArr['region_start']);
		$regionEnd = trim($paramArr['region_end']);
		$mainStart = trim($paramArr['main_start']);
		$mainEnd = trim($paramArr['main_end']);
		$subStart = trim($paramArr['sub_start']);
		$subEnd = trim($paramArr['sub_end']);
		$sceneStart = trim($paramArr['scene_start']);
		$sceneEnd = trim($paramArr['scene_end']);
		$f1Start = trim($paramArr['f1_start']);
		$f1End = trim($paramArr['f1_end']);
		$f2Start = trim($paramArr['f2_start']);
		$f2End = trim($paramArr['f2_end']);
		$f3Start = trim($paramArr['f3_start']);
		$f3End = trim($paramArr['f3_end']);
		$transactionStart = trim($paramArr['transaction_start']);
		$transactionEnd = trim($paramArr['transaction_end']);
		$startDate = trim($paramArr['start_date']);
		$endDate = trim($paramArr['end_date']);
		$viewId = $paramArr['view_id'];
		if ($projectId==null||$projectId=='') {
			return $item;
		}else{
			$where.= " and project_id = $projectId";
		}
		if($currencyStart != null && $currencyStart != ""){
			$where.= " and currency_code >= '$currencyStart'";
		}
		if($currencyEnd != null && $currencyEnd != ""){
			$where.= " and currency_code <= '$currencyEnd'";
		}
		if($regionStart != null && $regionStart != ""){
			$where.= " and region_code >= '$regionStart'";
		}
		if($regionEnd != null && $regionEnd != ""){
			$where.= " and region_code <= '$regionEnd'";
		}
		if($mainStart != null && $mainStart != ""){
			$where.= " and main_code >= '$mainStart'";
		}
		if($mainEnd != null && $mainEnd != ""){
			$where.= " and main_code <= '$mainEnd'";
		}
		if($subStart != null && $subStart != ""){
			$where.= " and sub_code >= '$subStart'";
		}
		if($subEnd != null && $subEnd != ""){
			$where.= " and sub_code <= '$subEnd'";
		}
		if($sceneStart != null && $sceneStart != ""){
			$where.= " and scene_code >= '$sceneStart'";
		}
		if($sceneEnd != null && $sceneEnd != ""){
			$where.= " and scene_code <= '$sceneEnd'";
		}
		if($f1Start != null && $f1Start != ""){
			$where.= " and free_code1 >= '$f1Start'";
		}
		if($f1End != null && $f1End != ""){
			$where.= " and free_code1 <= '$f1End'";
		}
		if($f2Start != null && $f2Start != ""){
			$where.= " and free_code2 >= '$f2Start'";
		}
		if($f2End != null && $f2End != ""){
			$where.= " and free_code2 <= '$f2End'";
		}
		if($f3Start != null && $f3Start != ""){
			$where.= " and free_code3 >= '$f3Start'";
		}
		if($f3End != null && $f3End != ""){
			$where.= " and free_code3 <= '$f3End'";
		}
		if($transactionStart != null && $transactionStart != ""){
			$where.= " and transaction_code >= '$transactionStart'";
		}
		if($transactionEnd != null && $transactionEnd != ""){
			$where.= " and transaction_code <= '$transactionEnd'";
		}
		if($startDate != null && $startDate != ""){
			$where.= " and detail_record_date >= '$startDate'";
		}
		if($endDate != null && $endDate != ""){
			$where.= " and detail_record_date <= '$endDate'";
		}
		if($paramArr['sort'] == "" || $paramArr['sort'] == null){
			$paramArr['sort'] = "all_code";
		}
		if($paramArr['order'] == "" || $paramArr['order'] == null){
			$paramArr['order'] = "asc";
		}
		if($viewId != "" && $viewId != null){
			$sql  = "SELECT project_code FROM  t_biz_report_view_detail WHERE view_id= $viewId";
			$view = Db::getInstance()->getAll($sql);
			$where1 = '';
			for($i = 0 ; $i < count($view) ; $i++){
				$project_code = $view[$i]['project_code'];
				if($i == 0){
					$where1.= " main_sub_code = '$project_code'";
				}else{
					$where1.= " or main_sub_code = '$project_code'";
				}
			}
			if ($where1 != '') {
				$where .= " and ($where1)";
			}
		}
		$item = ObjectUtils::arrToObj($paramArr, $item);
		$arr = $itemMapper->find($item,$where,'','',$paramArr['sort'],$paramArr['order']);
		return $arr;
	}

	public static function retrieveAllItem($paramArr) {
		$arr = array();
		$itemMapper = new TransactionDetailMapper();
		$item = new TransactionDetail();
		$where = " where 1=1";
		$BatchCodeData = BatchFunction::retrieveBatchCode($paramArr);
		$paramArr['page'] = 1;
		$paramArr['rows'] = PHP_INT_MAX;
		$dataArr = array();
		//var_dump($BatchCodeData);die;
		foreach ($BatchCodeData['rows'] as $value){
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
				$dataArr['all_code'] = "Code:".$mainCode." ".$subCode." ".$value['code_desc_en'];
				//$dataArr['all_code'] = $mainCode." ".$subCode." ".$value['code_desc_en'];
				//$dataArr['all_code'] = $mainCode." ".$subCode;
				$dataArr['is_asset'] = "";
				$dataArr['transaction_code'] = "";
				$dataArr['detail_desc'] = "";
				$dataArr['amount'] = "Total:".number_format($amount).'.00';
			} else {
				$dataArr['all_code'] = "编码：".$mainCode." ".$subCode." ".$value['code_desc_zh'];
				//$dataArr['all_code'] = $mainCode." ".$subCode." ".$value['code_desc_zh'];
				//$dataArr['all_code'] = $mainCode." ".$subCode." ";
				$dataArr['is_asset'] = "";
				$dataArr['transaction_code'] = "";
				$dataArr['detail_desc'] = "";
				$dataArr['amount'] = "合计：".number_format($amount).'.00';
			}
			$rs[] = $dataArr;
			for ($i = 0; $i <count($dataArray['rows']) ; $i++) {
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
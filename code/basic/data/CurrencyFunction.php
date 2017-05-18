<?php

namespace basic\data;

use utils\ObjectUtils;
use utils\ReturnResult;
use dao\Db;
use common\Constants;
use utils\ExcelUtils;

class CurrencyFunction {
	
	public static function retrieveitem($paramArr){
		$arr = array();
		$itemMapper = new CurrencyMapper();
		$item = new Currency();
		$where = " where 1=1 ";
		$codeId = trim($paramArr['code_id']);
		$recordCode = trim($paramArr['record_ids']);
		$projectId = $_SESSION['hqinfo_qm_current_user_project_id_session'];
		if ($projectId==null||$projectId=='') {
			return $item;
		}else{
			$where.= " and project_id = $projectId";
		}
		if($codeId != null && $codeId != ""){
			$where.= " and currency_code_id = '$codeId'";
		}
		if($recordCode != null && $recordCode != ""){
			$where.= " and record_id = $recordCode";
		}
		$item = ObjectUtils::arrToObj($paramArr, $item);
		$arr = $itemMapper->find($item,$where,'','','currency_code_id');
		return $arr;
	}
	
	public static function retrieveAllitem($paramArr){
		$arr = array();
		$where = " where project_id=".$paramArr['project_ids'];
		$orderBy = " order by currency_type asc";
		$sql = "select *  from v_biz_project_currency".$where.$orderBy;
		$arr = Db::getInstance()->getAll($sql);
		return $arr;
	}
	
	public static function createitem($paramArr){
		$arr = array();
		$itemMapper = new CurrencyMapper();
		$item = new Currency();
		$currencyTypeId = CurrencyTypeFunction::createitem($paramArr);
		$item = ObjectUtils::arrToObj($paramArr, $item);
		$item->setcurrency_type_id($currencyTypeId);
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
		$itemMapper = new CurrencyMapper();
		$item = new Currency();
		$currencyTypeId = CurrencyTypeFunction::updateitem($paramArr);
		$item = ObjectUtils::arrToObj($paramArr, $item);
		$item->setlast_update_date(date('Y-m-d H:i:s', time()));
		$item->setlast_update_by($_SESSION[Constants::LOGINED_USER_ID_IN_SESSION]);
		$res = $itemMapper->update($item);
		$arr = ReturnResult::returnMsg($res);
		return $arr;
	}
	
	//导出
	public static function exportItem($paramArr){
		$arr = array();
		$itemMapper = new CurrencyMapper();
		$item = new Currency();
		$where = ' WHERE 1=1 ';
		$projectId = $_SESSION['hqinfo_qm_current_user_project_id_session'];
		if ($projectId==null||$projectId=='') {
			return $item;
		}else{
			$where.= " and project_id = $projectId";
		}
		$item->page = 1;
		$item->rows = PHP_INT_MAX;
		$dataArray = $itemMapper->find($item, $where, '', Currency::$excelHeaderFields,'currency_code_id');
		for ($i=0; $i <count($dataArray['rows']) ; $i++) {
			$rs[$i]=$item->formatterObjByExcel($dataArray['rows'][$i]);
		}
		$types = $itemMapper->getColType($item->tableView, Currency::$excelHeaderFields);
		$language = $paramArr['language'];
		if($language == "en"){
			$excel_name = ExcelUtils::createExcelByModel('currency',
				BASE_DIR.'uploads/excelModel/currency-en.xls', $rs, null, null, null, null, null, $types);
		}else{
			$excel_name = ExcelUtils::createExcelByModel('currency',
				BASE_DIR.'uploads/excelModel/currency.xls', $rs, null, null, null, null, null, $types);
		}
		$arr['result'] = Constants::RESULT_CODE_SUCCESS;
		$arr['msg'] = $excel_name;
		return $arr;
	}
	
}

?>
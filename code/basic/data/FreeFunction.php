<?php

namespace basic\data;

use utils\ObjectUtils;
use utils\ReturnResult;
use dao\Db;
use common\Constants;
use utils\ExcelUtils;

class FreeFunction {
	
	public static function retrieveitem($paramArr){
		$arr = array();
		$itemMapper = new FreeMapper();
		$item = new Free();
		$where = " where 1=1 ";
		$freeCode = trim($paramArr['free_codes']);
		$recordCode = trim($paramArr['record_ids']);
		$projectId = $_SESSION['hqinfo_qm_current_user_project_id_session'];
		if ($projectId==null||$projectId=='') {
			return $item;
		}else{
			$where.= " and project_id = $projectId";
		}
		if($freeCode != null && $freeCode != ""){
			$where.= " and free_code = '$freeCode'";
		}
		if($recordCode != null && $recordCode != ""){
			$where.= " and record_id = $recordCode";
		}
		$item = ObjectUtils::arrToObj($paramArr, $item);
		$arr = $itemMapper->find($item , $where,'','','free_code');
		return $arr;
	}
	
	public static function createitem($paramArr){
		$arr = array();
		$itemMapper = new FreeMapper();
		$item = new Free();
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
		$itemMapper = new FreeMapper();
		$item = new Free();
		$item = ObjectUtils::arrToObj($paramArr, $item);
		$item->setlast_update_date(date('Y-m-d H:i:s', time()));
		$item->setlast_update_by($_SESSION[Constants::LOGINED_USER_ID_IN_SESSION]);
		$res = $itemMapper->update($item);
		$arr = ReturnResult::returnMsg($res);
		return $arr;
	}
	
	public static function retrieveitemCode($paramArr){
		$arr = array();
		$itemMapper = new FreeMapper();
		$item = new Free();
		$item = ObjectUtils::arrToObj($paramArr, $item);
		$arr = $itemMapper->findAll($item);
		return $arr;
	}
	
	//导出
	public static function exportItem($paramArr){
		$arr = array();
		$itemMapper = new FreeMapper();
		$item = new Free();
		$where = ' WHERE 1=1 ';
		$paramValue = $paramArr['free_type'];
		if($paramValue != null && $paramValue != ""){
			$where .= " and free_type = $paramValue";
		}
		$projectId = $_SESSION['hqinfo_qm_current_user_project_id_session'];
		if ($projectId==null||$projectId=='') {
			return $item;
		}else{
			$where.= " and project_id = $projectId";
		}
		$item->page = 1;
		$item->rows = PHP_INT_MAX;
		$dataArray = $itemMapper->find($item, $where, '', Free::$excelHeaderFields,'free_code');
		for ($i=0; $i <count($dataArray['rows']) ; $i++) {
			$rs[$i]=$item->formatterObjByExcel($dataArray['rows'][$i]);
		}
		$types = $itemMapper->getColType($item->tableView, Free::$excelHeaderFields);
		$language = $paramArr['language'];
		$type = $paramArr['free_type'];
		if($language == "en"){
			if($type == 1){
				$excel_name = ExcelUtils::createExcelByModel('free1',
						BASE_DIR.'uploads/excelModel/free1-en.xls', $rs, null, null, null, null, null, $types);
			}else if($type == 2){
				$excel_name = ExcelUtils::createExcelByModel('free2',
						BASE_DIR.'uploads/excelModel/free2-en.xls', $rs, null, null, null, null, null, $types);
			}else if($type == 3){
				$excel_name = ExcelUtils::createExcelByModel('free3',
						BASE_DIR.'uploads/excelModel/free3-en.xls', $rs, null, null, null, null, null, $types);
			}
		}else{
			if($type == 1){
				$excel_name = ExcelUtils::createExcelByModel('free1',
						BASE_DIR.'uploads/excelModel/free1.xls', $rs, null, null, null, null, null, $types);
			}else if($type == 2){
				$excel_name = ExcelUtils::createExcelByModel('free2',
						BASE_DIR.'uploads/excelModel/free2.xls', $rs, null, null, null, null, null, $types);
			}else if($type == 3){
				$excel_name = ExcelUtils::createExcelByModel('free3',
						BASE_DIR.'uploads/excelModel/free3.xls', $rs, null, null, null, null, null, $types);
			}
		}
		$arr['result'] = Constants::RESULT_CODE_SUCCESS;
		$arr['msg'] = $excel_name;
		return $arr;
	}
	
}

?>
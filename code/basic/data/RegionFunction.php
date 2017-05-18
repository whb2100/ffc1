<?php

namespace basic\data;

use utils\ObjectUtils;
use utils\ReturnResult;
use dao\Db;
use common\Constants;
use utils\ExcelUtils;

class RegionFunction {
	
	public static function retrieveitem($paramArr){
		$arr = array();
		$itemMapper = new RegionMapper();
		$item= new Region();
		$where = " where 1=1 ";
		$regionCode = trim($paramArr['region_codes']);
		$recordCode = trim($paramArr['record_ids']);
		$projectId = $_SESSION['hqinfo_qm_current_user_project_id_session'];
		if ($projectId==null||$projectId=='') {
			return $item;
		}else{
			$where.= " and project_id = $projectId";
		}
		if($regionCode != null && $regionCode != ""){
			$where.= " and region_code = '$regionCode'";
		}
		if($recordCode != null && $recordCode != ""){
			$where.= " and record_id = $recordCode";
		}
		$item = ObjectUtils::arrToObj($paramArr, $item);
		$arr = $itemMapper->find($item,$where,'','','region_code');
		return $arr;
	}
	
	public static function createitem($paramArr){
		$arr = array();
		$itemMapper = new RegionMapper();
		$item = new Region();
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
		$itemMapper = new RegionMapper();
		$item = new Region();
		$item = ObjectUtils::arrToObj($paramArr, $item);
		$item->setlast_update_date(date('Y-m-d H:i:s', time()));
		$item->setlast_update_by($_SESSION[Constants::LOGINED_USER_ID_IN_SESSION]);
		$res = $itemMapper->update($item);
		$arr = ReturnResult::returnMsg($res);
		return $arr;
	}
	
	public static function retrieveitemCode($paramArr){
		$arr = array();
		$itemMapper = new RegionMapper();
		$item = new Region();
		$item = ObjectUtils::arrToObj($paramArr, $item);
		$arr = $itemMapper->findAll($item);
		return $arr;
	}
	
	//导出
	public static function exportItem($paramArr){
		$arr = array();
		$itemMapper = new RegionMapper();
		$item = new Region();
		$where = ' WHERE 1=1 ';
		$projectId = $_SESSION['hqinfo_qm_current_user_project_id_session'];
		if ($projectId==null||$projectId=='') {
			return $item;
		}else{
			$where.= " and project_id = $projectId";
		}
		$item->page = 1;
		$item->rows = PHP_INT_MAX;
		$dataArray = $itemMapper->find($item, $where, '', Region::$excelHeaderFields,'region_code');
		for ($i=0; $i <count($dataArray['rows']) ; $i++) {
			$rs[$i]=$item->formatterObjByExcel($dataArray['rows'][$i]);
		}
		$types = $itemMapper->getColType($item->tableView, Region::$excelHeaderFields);
		$language = $paramArr['language'];
		if($language == "en"){
			$excel_name = ExcelUtils::createExcelByModel('region',
				BASE_DIR.'uploads/excelModel/region-en.xls', $rs, null, null, null, null, null, $types);
		}else{
			$excel_name = ExcelUtils::createExcelByModel('region',
				BASE_DIR.'uploads/excelModel/region.xls', $rs, null, null, null, null, null, $types);
		}
		$arr['result'] = Constants::RESULT_CODE_SUCCESS;
		$arr['msg'] = $excel_name;
		return $arr;
	}
	
}

?>
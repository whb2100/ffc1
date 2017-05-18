<?php

namespace batch\data;

use utils\ObjectUtils;
use utils\ReturnResult;
use dao\Db;
use common\Constants;
use utils\ExcelUtils;

class BatchFunction {
	
	public static function retrieveitem($paramArr){
		$arr = array();
		$itemMapper = new BatchMapper();
		$item = new Batch();
		$where = " where 1=1 ";
		$batchId = trim($paramArr['batch_ids']);
		$projectId = trim($paramArr['project_ids']);
		if($batchId != null && $batchId != ""){
			$where.= " and batch_id = $batchId";
		}
		if($projectId != null && $projectId != ""){
			$where.= " and project_id = $projectId";
		}
		$item = ObjectUtils::arrToObj($paramArr, $item);
		$arr = $itemMapper->find($item,$where);
		return $arr;
	}
	
	public static function createitem($paramArr){
		$arr = array();
		$itemMapper = new BatchMapper();
		$item = new Batch();
		$item = ObjectUtils::arrToObj($paramArr, $item);
		$item->setcreate_date(date('Y-m-d H:i:s', time()));
		$item->setcreate_by($_SESSION[Constants::LOGINED_USER_ID_IN_SESSION]);
		$item->setlast_update_date(date('Y-m-d H:i:s', time()));
		$item->setlast_update_by($_SESSION[Constants::LOGINED_USER_ID_IN_SESSION]);
		$res = $itemMapper->save($item);
		$arr['msg'] = ReturnResult::returnMsg($res);
		$arr['id'] = $res;
		return $arr;
	}
	
	public static function updateitem($paramArr){
		$arr = array();
		$itemMapper = new BatchMapper();
		$item = new Batch();
		$item = ObjectUtils::arrToObj($paramArr, $item);
		$item->setlast_update_date(date('Y-m-d H:i:s', time()));
		$item->setlast_update_by($_SESSION[Constants::LOGINED_USER_ID_IN_SESSION]);
		$res = $itemMapper->update($item);
		$arr = ReturnResult::returnMsg($res);
		return $arr;
	}
	
	public static function deleteitem($paramArr){
		$arr = array();
		$itemMapper = new BatchMapper();
		$item = new Batch();
		$item = ObjectUtils::arrToObj($paramArr, $item);
		$res = $itemMapper->delete($item);
		$arr = ReturnResult::returnMsg($res);
		return $arr;
	}
	
	public static function itemNameCheck($paramArr){
		$arr = array();
		$itemMapper = new BatchMapper();
		$item = new Batch();
		$where = " where 1=1";
		$batchCode= trim($paramArr['batch_codes']);
		$projectId = trim($paramArr['project_ids']);
		if($batchCode != null && $batchCode != ""){
			$where.= " and batch_code = '$batchCode'";
		}
		if($projectId != null && $projectId != ""){
			$where.= " and project_id = $projectId";
		}
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
	
	public static function retrieveBatchCode($paramArr){
		$arr = array();
		$itemMapper = new BatchMapper();
		$item = new BatchCode();
		$where = " where 1=1 ";
		$batchId = trim($paramArr['batch_ids']);
		if($batchId != null && $batchId != ""){
			$where.= " and batch_id = $batchId";
		}
		$item = ObjectUtils::arrToObj($paramArr, $item);
		$arr = $itemMapper->find($item,$where);
		return $arr;
	}
	
}

?>
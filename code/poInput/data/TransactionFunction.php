<?php

namespace poInput\data;

use utils\ObjectUtils;
use utils\ReturnResult;
use dao\Db;
use common\Constants;
use utils\ExcelUtils;

class TransactionFunction {
	
	public static function retrieveitem($paramArr){
		$arr = array();
		$itemMapper = new TransactionMapper();
		$item = new Transaction();
		$where = " where 1=1 ";
		$batchId = trim($paramArr['batch_ids']);
		if($batchId != null && $batchId != ""){
			$where.= " and batch_id = $batchId";
		}
		$item = ObjectUtils::arrToObj($paramArr, $item);
		$arr = $itemMapper->find($item,$where);
		return $arr;
	}
	
	public static function createitem($paramArr){
		$jsonArray = json_decode(stripcslashes($paramArr['transaction_detail']),true);
		$detailArray = array();
		
		$arr = array();
		$itemMapper = new TransactionMapper();
		$item = new Transaction();
		
		$item = ObjectUtils::arrToObj($paramArr, $item);
		$item->setcreate_date(date('Y-m-d H:i:s', time()));
		$item->setcreate_by($_SESSION[Constants::LOGINED_USER_ID_IN_SESSION]);
		$item->setlast_update_date(date('Y-m-d H:i:s', time()));
		$item->setlast_update_by($_SESSION[Constants::LOGINED_USER_ID_IN_SESSION]);
		$transactionId = $itemMapper->save($item);
		
		foreach ($jsonArray as $value){
			$detailArray['transaction_id'] = $transactionId;
			$detailArray['goods_id'] = $value['goods_id'];
			$detailArray['project_region_id'] = $value['project_region_id'];
			$detailArray['project_code_id'] = $value['code_id'];
			$detailArray['project_scene_id'] = $value['project_scene_id'];
			$detailArray['project_free1_id'] = $value['project_free1_id'];
			$detailArray['project_free2_id'] = $value['project_free2_id'];
			$detailArray['project_free3_id'] = $value['project_free3_id'];
			$detailArray['is_asset'] = $value['is_asset'];
			$detailArray['amount'] = $value['amount'];
			$detailArray['detail_desc'] = $value['detail_desc'];
			TransactionDetailFunction::createitem($detailArray);
		}
		
		$arr = ReturnResult::returnMsg($transactionId);
		return $arr;
	}
	
	public static function updateitem($paramArr){
		$jsonArray = json_decode(stripcslashes($paramArr['transaction_detail']),true);
		$detailArray = array();
		$detailParamArr = array();
		
		$arr = array();
		$itemMapper = new TransactionMapper();
		$item = new Transaction();
		
		$item = ObjectUtils::arrToObj($paramArr, $item);
		$item->setcreate_date(date('Y-m-d H:i:s', time()));
		$item->setcreate_by($_SESSION[Constants::LOGINED_USER_ID_IN_SESSION]);
		$item->setlast_update_date(date('Y-m-d H:i:s', time()));
		$item->setlast_update_by($_SESSION[Constants::LOGINED_USER_ID_IN_SESSION]);
		$transactionId = $itemMapper->update($item);
		
		$sql = "DELETE FROM T_BIZ_PO_TRANSACTION_DETAIL WHERE TRANSACTION_ID=".$paramArr['transaction_id'];
		Db::getInstance()->exec($sql);
		
		foreach ($jsonArray as $value){
			$detailArray['transaction_id'] = $paramArr['transaction_id'];
			$detailArray['goods_id'] = $value['goods_id'];
			$detailArray['project_region_id'] = $value['project_region_id'];
			$detailArray['project_code_id'] = $value['code_id'];
			$detailArray['project_scene_id'] = $value['project_scene_id'];
			$detailArray['project_free1_id'] = $value['project_free1_id'];
			$detailArray['project_free2_id'] = $value['project_free2_id'];
			$detailArray['project_free3_id'] = $value['project_free3_id'];
			$detailArray['is_asset'] = $value['is_asset'];
			$detailArray['amount'] = $value['amount'];
			$detailArray['detail_desc'] = $value['detail_desc'];
			TransactionDetailFunction::createitem($detailArray);
		}
		
		$arr = ReturnResult::returnMsg($transactionId);
		return $arr;
	}
	
	public static function clearitem($paramArr){
		$arr = array();
// 		$dataArray = BatchFunction::retrieveitem($paramArr);
// 		foreach ($dataArray['rows'] as $value) {
			$itemMapper = new TransactionMapper();
			$item = new Transaction();
// 			$item = ObjectUtils::arrToObj($paramArr, $item);
			$updateDate = date('Y-m-d H:i:s', time());
			$updateBy = $_SESSION[Constants::LOGINED_USER_ID_IN_SESSION];
// 			$batchId = $value['batch_id'];
			$batchId = $paramArr['batch_id'];
			$sql = "update t_biz_po_transaction_info set total_amount=0 , last_update_by='$updateBy' , last_update_date='$updateDate' where batch_id=$batchId";
			Db::getInstance()->exec($sql);
			$batchArr = array();
			$batchArr['batch_ids'] = $batchId;
			$dataDetailArray = TransactionFunction::retrieveitem($batchArr);
			foreach ($dataDetailArray['rows'] as $detailValue) {
				if($detailValue['transaction_id'] != null){
					$itemDetailMapper = new TransactionDetailMapper();
					$itemDetail = new TransactionDetail();
					$updateDetailDate = date('Y-m-d H:i:s', time());
					$updateDetailBy = $_SESSION[Constants::LOGINED_USER_ID_IN_SESSION];
					$transactionId = $detailValue['transaction_id'];
					$detailsql = "update t_biz_po_transaction_detail set amount=0 , last_update_by='$updateDetailBy' , last_update_date='$updateDetailDate' where transaction_id=$transactionId";
					$res = Db::getInstance()->exec($detailsql);
				}
			}
// 		}
		$arr = ReturnResult::returnMsg($res);
		return $arr;
	}
	
	public static function itemNameCheck($paramArr){
		$arr = array();
		$itemMapper = new TransactionMapper();
		$item = new Transaction();
		$where = " where 1=1 ";
		$transactionCode = trim($paramArr['transaction_codes']);
		$batchId = trim($paramArr['batch_ids']);
		if($transactionCode != null && $transactionCode != ""){
			$where.= " and transaction_code = '$transactionCode'";
		}
		if($batchId != null && $batchId != ""){
			$where.= " and batch_id = $batchId";
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
	
}

?>
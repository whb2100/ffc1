<?php

namespace vouchers\data;

use utils\ObjectUtils;
use utils\ReturnResult;
use dao\Db;
use common\Constants;

class VouchersFunction {

	public static function retrieveItem($paramArr){
		$arr = array();
		$itemMapper = new VouchersMapper();
		$item = new Vouchers();
		$where = " where 1=1 ";
		$projectId = $_SESSION['hqinfo_qm_current_user_project_id_session'];
		if ($projectId==null||$projectId=='') {
			return $item;
		}else{
			$where.= " and project_id = $projectId";
		}
		$item = ObjectUtils::arrToObj($paramArr, $item);
		$arr = $itemMapper->find($item,$where,'','',$paramArr['sort'],$paramArr['order']);
		return $arr;
	}
	
	public static function retrieveTree($paramArr){
		$arr = array();
		$arr1 = array();
		$arr2 = array();
		$arr3 = array();
		$itemMapper = new VouchersMapper();
		$item = new Vouchers();
		$where = " where 1=1 ";
		$projectId = $_SESSION['hqinfo_qm_current_user_project_id_session'];
		$language = $_SESSION['language'];
		if ($projectId==null||$projectId=='') {
			return $item;
		}else{
			$where.= " and project_id = $projectId";
		}
		$item = ObjectUtils::arrToObj($paramArr, $item);
		$arr = $itemMapper->find($item,$where,'','','create_date','DESC');
		if($arr['total'] < 1){
			return "";
		}
		$isVouchers = 0;
		$isContract = 0;
		for($i = 0 ; $i < $arr['total'] ; $i++){
			if($arr['rows'][$i]['vouchers_type'] == -1){
				$isVouchers = 1;
			}
			if($arr['rows'][$i]['vouchers_type'] == -2){
				$isContract = 1;
			}
		}
		//凭证和合同同时存在
		if($isVouchers==1 && $isContract==1){
			if($language == "en"){
				$arr1['vouchers_name'] = "VOUCHERS";
			}else{
				$arr1['vouchers_name'] = "凭证";
			}
			if($language == "en"){
				$arr2['vouchers_name'] = "CONTRACT";
			}else{
				$arr2['vouchers_name'] = "合同";
			}
			$arr1['state'] = "closed";
			$arr1['vouchers_type'] = -3;
			$arr1['vouchers_id'] = -1;
			$arr2['state'] = "closed";
			$arr2['vouchers_type'] = -3;
			$arr2['vouchers_id'] = -2;
			$arr3['vouchers_name'] = $paramArr['name'];
			$arr3['state'] = "closed";
			$arr3['vouchers_id'] = -3;
			$arr['rows'][] = $arr1;
			$arr['rows'][] = $arr2;
			$arr['rows'][] = $arr3;
		}else if($isVouchers==0 && $isContract==1){
			if($language == "en"){
				$arr2['vouchers_name'] = "CONTRACT";
			}else{
				$arr2['vouchers_name'] = "合同";
			}
			$arr2['state'] = "closed";
			$arr2['vouchers_type'] = -3;
			$arr2['vouchers_id'] = -2;
			$arr3['vouchers_name'] = $paramArr['name'];
			$arr3['state'] = "closed";
			$arr3['vouchers_id'] = -3;
			$arr['rows'][] = $arr2;
			$arr['rows'][] = $arr3;
		}else if($isVouchers==1 && $isContract==0){
			if($language == "en"){
				$arr1['vouchers_name'] = "VOUCHERS";
			}else{
				$arr1['vouchers_name'] = "凭证";
			}
			$arr1['state'] = "closed";
			$arr1['vouchers_type'] = -3;
			$arr1['vouchers_id'] = -1;
			$arr3['vouchers_name'] = $paramArr['name'];
			$arr3['state'] = "closed";
			$arr3['vouchers_id'] = -3;
			$arr['rows'][] = $arr1;
			$arr['rows'][] = $arr3;
		}
		$arr = $arr['rows'];
		return $arr;
	}
	
	public static function createitem($paramArr){
		$arr = array();
		$itemMapper = new VouchersMapper();
		$item = new Vouchers();
		$projectId = $_SESSION['hqinfo_qm_current_user_project_id_session'];
		$item = ObjectUtils::arrToObj($paramArr, $item);
		$item->setproject_id($projectId);
		$item->setcreate_date(date('Y-m-d H:i:s', time()));
		$item->setcreate_by($_SESSION[Constants::LOGINED_USER_ID_IN_SESSION]);
		$res = $itemMapper->save($item);
		$arr = ReturnResult::returnMsg($res);
		return $arr;
	}
	
	public static function vouchersRepeatCheck($paramArr){
		$arr = array();
		$itemMapper = new VouchersMapper();
		$item = new Vouchers();
		$where = " where 1=1 ";
		$projectId = $_SESSION['hqinfo_qm_current_user_project_id_session'];
		$vouchersName = $paramArr['vouchers'];
		if ($projectId==null||$projectId=='') {
			return $item;
		}else{
			$where.= " and project_id = $projectId";
		}
		if ($vouchersName !=null || $vouchersName != '') {
			$where.= " and vouchers_name = '$vouchersName'";
		}
		$item = ObjectUtils::arrToObj($paramArr, $item);
		$arr = $itemMapper->find($item,$where);
		return $arr;
	}

}

?>
<?php 
namespace etc\data;

use utils\ObjectUtils;
use utils\ReturnResult;
use dao\Db;
use common\Constants;
use utils\ExcelUtils;
use basic\data\CodeFunction;

class EtcFunction {
	
	public static function retrieveitem($paramArr){
		$arr = array();
		$itemMapper = new EtcMapper();
		$item = new Etc();
		$where = " where 1=1 ";
		$mainCode = trim($paramArr['main_codes']);
		$subCode = trim($paramArr['sub_codes']);
		$projectId = trim($paramArr['project_ids']);
		if($paramArr['main_codes'] != null && $paramArr['main_codes'] != "" && $paramArr['sub_codes'] != null && $paramArr['sub_codes'] != ""){
			$where.= " and main_code = '$mainCode' and sub_code = '$subCode'";
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
		$itemMapper = new EtcMapper();
		$item = new Etc();
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
		$itemMapper = new EtcMapper();
		$item = new Etc();
		$item = ObjectUtils::arrToObj($paramArr, $item);
		$item->setlast_update_date(date('Y-m-d H:i:s', time()));
		$item->setlast_update_by($_SESSION[Constants::LOGINED_USER_ID_IN_SESSION]);
		$res = $itemMapper->update($item);
		$arr = ReturnResult::returnMsg($res);
		return $arr;
	}
	
	public static function clearitem($paramArr){
		$arr = array();
		$itemMapper = new EtcMapper();
		$item = new Etc();
		$item = ObjectUtils::arrToObj($paramArr, $item);
		$updateDate = date('Y-m-d H:i:s', time());
		$projectId = $paramArr['project_ids'];
		$updateBy = $_SESSION[Constants::LOGINED_USER_ID_IN_SESSION];
		$sql = "update t_biz_project_code set last_amount=0 , last_update_by='$updateBy' , last_update_date='$updateDate' where project_id=$projectId";
		$res = Db::getInstance()->exec($sql);
		$arr = ReturnResult::returnMsg($res);
		return $arr;
	}
	
	//批量创建
	public static function createBudgetsByExcel($excelFile , $paramArr){
		$item = new Etc();
		$dataArray = ExcelUtils::readExcel($excelFile,new Etc());
		$itemMapper = new EtcMapper();
		$arr = array();
		if($dataArray == null){
			$arr['result'] =  11001;
			// $arr['msg'] = '请选择正确的EXCEL(.xls)文件！';
			return $arr;
		}
			// 
		foreach ($dataArray as $key => $value) {
			// $val['main_codes'] = $value['main_code'];
			$vals['main_code'] = $value['main_code'];
			// $val['sub_codes'] = $value['sub_code'];
			$vals['sub_code'] = $value['sub_code'];
			// $array = CodeFunction::retrieveitem($val);
			$arrays = EtcFunction::retrieveitem($vals);
			
			$vals['code_type'] = 2;
			$vals['project_id'] = $paramArr['project_id'];
			$arrays2 = CodeFunction::retrieveitem($vals);
			
			// if ($array['total'] != 1) {
			// 	$arr['result'] =  11002;
			// 	// $arr['msg'] = 'EXCEL文件中有编码不在基础设置中！';
			// 	return $arr;
			// }
			if ($arrays['total'] >0) {
				
				$arr['result'] =  11003;
				// $arr['msg'] = 'EXCEL文件中有编码已被使用！';
				return $arr;
			}
			
			if ($arrays2['total'] < 1) {
				$arr['result'] =  11005;
				// $arr['msg'] = 'EXCEL文件中有编码已被使用！';
				return $arr;
			}
		}

		foreach ($dataArray as $keys => $values) {
			// var_dump($value);die;
			$item = ObjectUtils::arrToObj($values, $item);
			$item->setCreate_date(date('Y-m-d H:i:s', time()));
			$item->setProject_id($_SESSION[Constants::LOGINEN_USER_PROJECT_ID_IN_SESSION]);
			$item->setCreate_by($_SESSION[Constants::LOGINED_USER_ID_IN_SESSION]);
			$item->setLast_update_date(date('Y-m-d H:i:s', time()));
			$item->setLast_update_by($_SESSION[Constants::LOGINED_USER_ID_IN_SESSION]);
			$itemMapper->save($item);
		}
		$arr = ReturnResult::returnMsg(true);
		return $arr;
	}
	
}

?>
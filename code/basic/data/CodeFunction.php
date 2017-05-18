<?php

namespace basic\data;

use utils\ObjectUtils;
use utils\ReturnResult;
use dao\Db;
use common\Constants;
use utils\ExcelUtils;

class CodeFunction {
	
	public static function retrieveitem($paramArr,$head){
		$arr = array();
		$itemMapper = new CodeMapper();
		$item = new Code();
		$where = " where 1=1 ";
		$mainCode = trim($paramArr['main_codes']);
		$subCode = trim($paramArr['sub_codes']);
		$recordCode = trim($paramArr['record_ids']);
// 		$createBy = trim($paramArr['create']);
		$projectId = $_SESSION['hqinfo_qm_current_user_project_id_session'];
		if ($projectId==null||$projectId=='') {
			return $item;
		}else{
			$where.= " and project_id = $projectId";
		}
		if($paramArr['main_codes'] != null && $paramArr['main_codes'] != "" && $paramArr['sub_codes'] != null && $paramArr['sub_codes'] != ""){
			$where.= " and main_code = '$mainCode' and sub_code = '$subCode'";
		}
		if($recordCode != null && $recordCode != ""){
			$where.= " and record_id = $recordCode";
		}
		$code_type = $paramArr['code_type'];
		if($code_type != null && $code_type != ""){
			$where.= " and code_type = $code_type";
		}
		$item = ObjectUtils::arrToObj($paramArr, $item);
		$arr = $itemMapper->find($item,$where,'',$head,'main_code,sub_code');
		return $arr;
	}
	
	public static function createitem($paramArr){
		$arr = array();
		$itemMapper = new CodeMapper();
		$item = new Code();
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
		$itemMapper = new CodeMapper();
		$item = new Code();
		$item = ObjectUtils::arrToObj($paramArr, $item);
		$item->setlast_update_date(date('Y-m-d H:i:s', time()));
		$item->setlast_update_by($_SESSION[Constants::LOGINED_USER_ID_IN_SESSION]);
		$res = $itemMapper->update($item);
		$arr = ReturnResult::returnMsg($res);
		return $arr;
	}
// 删除
	public static function deleteitem($paramArr){
		$arr = array();
		$itemMapper = new CodeMapper();
		$item = new Code();
		$item = ObjectUtils::arrToObj($paramArr, $item);
		$ids = $paramArr['record_ids'];
		// 检查是否被使用

		$projectId = $_SESSION[Constants::LOGINEN_USER_PROJECT_ID_IN_SESSION];
		$po_count = CodeFunction::countRecord('t_biz_po_transaction_detail',$projectId);
		$batch_count = CodeFunction::countRecord('t_biz_transaction_detail',$projectId);
		if($po_count>0||$batch_count>0){
			$arr['result'] =  11006;
			// $arr['msg'] = '项目预算已被使用，无法删除'！';
			return $arr;
		}

		if ($ids!= null && $ids != "") {
			$sql = "delete  from t_biz_project_code where record_id in (".$ids.")";
			$res = $itemMapper->conn->exec($sql);
			$arr = ReturnResult::returnMsg($res);
		}else{
			$arr = ReturnResult::returnMsg(false);
		}
		
		return $arr;
	}

// sql查询表中数据条数
	public static function countRecord($table,$projectId){
		$itemMapper = new CodeMapper();
		$sql = "select count(*) from ".$table." where project_code_id   in  (".$projectId.")";
		$res = $itemMapper->conn->getTotal($sql);
		return $res;
	}
	//批量创建
	public static function createBudgetsByExcel($excelFile){
		$item = new Code();
		$dataArray = ExcelUtils::readExcel($excelFile,new Code());
		// var_dump($dataArray);die;
		$itemMapper = new CodeMapper();
		$arr = array();
		if($dataArray == null){
			$arr['result'] =  11001;
			// $arr['msg'] = '请选择正确的EXCEL(.xls)文件！';
			return $arr;
		}
		// 检查是否被使用
		$projectId = $_SESSION[Constants::LOGINEN_USER_PROJECT_ID_IN_SESSION];
		$po_count = CodeFunction::countRecord('t_biz_po_transaction_detail',$projectId);
		$batch_count = CodeFunction::countRecord('t_biz_transaction_detail',$projectId);
		if($po_count>0||$batch_count>0){
			$arr['result'] =  11004;
			// $arr['msg'] = '项目预算已被使用，无法导入'！';
			return $arr;
		}

		// 更新历史记录版本加1
		$sql_update = "update t_his_project_code set version_num=version_num+1 where project_id=".$projectId;
		$itemMapper->conn->exec($sql_update);
		// 复制到历史记录表
		$sql_copy = "insert into t_his_project_code(project_id,main_code,sub_code,code_desc_zh,code_desc_en,code_type,amount,statistics_level_id,create_by,create_date,last_update_by,last_update_date,last_amount) select  project_id,main_code,sub_code,code_desc_zh,code_desc_en,code_type,amount,statistics_level_id,create_by,create_date,last_update_by,last_update_date,last_amount from t_biz_project_code where code_type='2' and project_id=".$projectId;
		$itemMapper->conn->exec($sql_copy);
		// 删除旧数据
		$sql_del = "delete  from t_biz_project_code where code_type='2' and  project_id =".$projectId;
		$itemMapper->conn->exec($sql_del);
			foreach ($dataArray as $keys => $values) {
			// var_dump($value);die;
				$values['statistics_level_id'] = (int)str_replace("LEVEL","",$values['statistics_level_id']);
				$item = ObjectUtils::arrToObj($values, $item);
				$item->setCreate_date(date('Y-m-d H:i:s', time()));
				$item->setProject_id($_SESSION[Constants::LOGINEN_USER_PROJECT_ID_IN_SESSION]);
				$item->setCode_type(2);
				$item->setCreate_by($_SESSION[Constants::LOGINED_USER_ID_IN_SESSION]);
				$item->setLast_update_date(date('Y-m-d H:i:s', time()));
				$item->setLast_update_by($_SESSION[Constants::LOGINED_USER_ID_IN_SESSION]);
				$res = $itemMapper->save($item);
			}
			// 更新历史last_amount到新表中
			$sql_amount = "UPDATE t_biz_project_code a, t_his_project_code b SET a.last_amount = b.last_amount WHERE  a.main_code =b.main_code and a.sub_code=b.sub_code  and b.version_num=0   and a.code_type='2'  and a.project_id=".$projectId."  and b.project_id=".$projectId;
			$itemMapper->conn->exec($sql_amount);
			$arr = ReturnResult::returnMsg(true);
		


		// 验证导入表格数据是否已经存在
		/*foreach ($dataArray as $key => $value) {
			// $val['main_codes'] = $value['main_code'];
			$vals['main_code'] = $value['main_code'];
			// $val['sub_codes'] = $value['sub_code'];
			$vals['sub_code'] = $value['sub_code'];
			// $array = CodeFunction::retrieveitem($val);
			$arrays = CodeFunction::retrieveitem($vals);
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
		}*/

		
		return $arr;
	}


	// 恢复记录
	public static function recoveryitem($paramArr){
		$arr = array();
		$itemMapper = new CodeMapper();
		// 检查是否被使用
		$projectId = $_SESSION[Constants::LOGINEN_USER_PROJECT_ID_IN_SESSION];
		$po_count = CodeFunction::countRecord('t_biz_po_transaction_detail',$projectId);
		$batch_count = CodeFunction::countRecord('t_biz_transaction_detail',$projectId);
		if($po_count>0||$batch_count>0){
			$arr['result'] =  11005;
			// $arr['msg'] = '项目预算已被使用，无法恢复'！';
			return $arr;
		}
		
		$sql = "select count(*) from t_his_project_code   where project_id   =".$projectId;
		$count = $itemMapper->conn->getTotal($sql);
		if ($count>0) {
			$sql_del = "delete  from t_biz_project_code where code_type='2' and project_id =".$projectId;
			$del = $itemMapper->conn->exec($sql_del);
			// if ($del) {
				$sql_copy = "insert into t_biz_project_code(project_id,main_code,sub_code,code_desc_zh,code_desc_en,code_type,amount,statistics_level_id,create_by,create_date,last_update_by,last_update_date,last_amount) select  project_id,main_code,sub_code,code_desc_zh,code_desc_en,code_type,amount,statistics_level_id,create_by,create_date,last_update_by,last_update_date,last_amount from t_his_project_code where version_num=0 and project_id=".$projectId;
				$res = $itemMapper->conn->exec($sql_copy);
				$arr = ReturnResult::returnMsg($res);
			// }
		}else{
			$arr = ReturnResult::returnMsg(false);
		}
		return $arr;
	}
	
	//导出
	public static function exportItem($paramArr){
		$arr = array();
		$itemMapper = new CodeMapper();
		$item = new Code();
		$where = ' WHERE 1=1 ';
		$projectId = $_SESSION['hqinfo_qm_current_user_project_id_session'];
		if ($projectId==null||$projectId=='') {
			return $item;
		}else{
			$where.= " and project_id = $projectId";
		}
		$paramValue = $paramArr['code_type'];
		if($paramValue != null && $paramValue != ""){
			$where .= " and code_type = $paramValue";
		}
		$item->page = 1;
		$item->rows = PHP_INT_MAX;
		$dataArray = $itemMapper->find($item, $where, '', Code::$excelModelFields,'main_code,sub_code');
		for ($i=0; $i <count($dataArray['rows']) ; $i++) {
			$rs[$i]=$item->formatterObjByExcel($dataArray['rows'][$i]);
		}
		$types = $itemMapper->getColType($item->tableView, Code::$excelModelFields);
		$language = $paramArr['language'];
		if($language == "en"){
			$excel_name = ExcelUtils::createExcelByModel('code',
				BASE_DIR.'uploads/excelModel/code-en.xls', $rs, null, null, null, null, null, $types);
		}else{
			$excel_name = ExcelUtils::createExcelByModel('code',
				BASE_DIR.'uploads/excelModel/code.xls', $rs, null, null, null, null, null, $types);
		}
		$arr['result'] = Constants::RESULT_CODE_SUCCESS;
		$arr['msg'] = $excel_name;
		return $arr;
	}
	
// 预算
	public static function exportExcel($paramArr){
		$arr = array();
		$itemMapper = new CodeMapper();
		$item = new Code();
		$paramArr['page'] = 1;
		$paramArr['rows'] = PHP_INT_MAX;
		// $projectId = $paramArr['project_id'];
		// var_dump($paramArr);die;
		// $where = "where project_id ='$projectId' ";
		$dataArray = CodeFunction::retrieveitem($paramArr,Code::$excelModelFields_bud);
		@$language = $_SESSION['language'];
		if ($language == 'en') {
			$excel_name = ExcelUtils::createExcelByModel('budget',BASE_DIR.'uploads/excelModel/budget-en.xls', $dataArray['rows']);
		}else{
			$excel_name = ExcelUtils::createExcelByModel('budget',BASE_DIR.'uploads/excelModel/budget.xls', $dataArray['rows']);
		}
		$arr['result'] = Constants::RESULT_CODE_SUCCESS;
		$arr['msg'] = $excel_name;
		return $arr;
	}
// ETC
	public static function exportExcelEtc($paramArr){
		$arr = array();
		$itemMapper = new CodeMapper();
		$item = new Code();
		$paramArr['page'] = 1;
		$paramArr['rows'] = PHP_INT_MAX;
		// $projectId = $paramArr['project_id'];
		// var_dump($paramArr);die;
		// $where = "where project_id ='$projectId' ";
		$dataArray = CodeFunction::retrieveitem($paramArr,Code::$excelModelFields_etc);
		foreach ($dataArray['rows'] as $key => $value) {
				$v = number_format($value['last_amount'],2);
				$value['last_amount'] = $v;
				$data[] =  $value;
		}
		// var_dump($data);die;
		@$language = $_SESSION['language'];
		if ($language == 'en') {
			$excel_name = ExcelUtils::createExcelByModel('etc',BASE_DIR.'uploads/excelModel/etc-en.xls', $data);
		}else{
			$excel_name = ExcelUtils::createExcelByModel('etc',BASE_DIR.'uploads/excelModel/etc.xls', $data);
		}
		$arr['result'] = Constants::RESULT_CODE_SUCCESS;
		$arr['msg'] = $excel_name;
		return $arr;
	}

	//批量创建ETC金额
	public static function createAmountByExcel($excelFile){
		$item = new Code();
		$dataArray = ExcelUtils::readExcel($excelFile,new Code());
		array_shift($dataArray);
		$itemMapper = new CodeMapper();
		$arr = array();
		$project_id = $_SESSION[Constants::LOGINEN_USER_PROJECT_ID_IN_SESSION];
		if($dataArray == null){
			$arr['result'] =  11001;
			// $arr['msg'] = '请选择正确的EXCEL(.xls)文件！';
			return $arr;
		}
			if ($project_id) {
				foreach ($dataArray as $keys => $values) {

					$last_amount = $values['amount'];
					$last_update_by = $_SESSION[Constants::LOGINED_USER_ID_IN_SESSION];
					$last_update_date = date('Y-m-d H:i:s', time());
					$main_code = $values['main_code'];
					$sub_code = $values['sub_code'];

					$sql = "update t_biz_project_code set last_amount='$last_amount',last_update_by='$last_update_by',last_update_date='$last_update_date' where project_id='$project_id' and main_code='$main_code' and sub_code='$sub_code' and code_type='2' ";
					// var_dump($sql);die;
					$itemMapper->conn->exec($sql);
				}
			$arr = ReturnResult::returnMsg(true);

			}else{
			$arr = ReturnResult::returnMsg(false);

			}
			
			

		
		return $arr;
	}
}

?>
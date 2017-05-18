<?php

namespace budget\data;

use utils\ObjectUtils;
use utils\ReturnResult;
use dao\Db;
use common\Constants;
use utils\ExcelUtils;


class HistoryFunction {
	
	public static function retrieveitem($paramArr){
		$arr = array();
		$itemMapper = new HistoryMapper();
		$item = new History();
		$where = " where 1=1 ";
		$mainCode = trim($paramArr['main_codes']);
		$subCode = trim($paramArr['sub_codes']);
		$recordCode = trim($paramArr['record_ids']);
// 		$createBy = trim($paramArr['create']);
		$projectId = trim($paramArr['project_ids']);
		$num = trim($paramArr['version_num']);
		if($paramArr['main_codes'] != null && $paramArr['main_codes'] != "" && $paramArr['sub_codes'] != null && $paramArr['sub_codes'] != ""){
			$where.= " and main_code = '$mainCode' and sub_code = '$subCode'";
		}
		if($recordCode != null && $recordCode != ""){
			$where.= " and record_id = $recordCode";
		}
// 		if($createBy != null && $createBy != ""){
// 			$where.= " and create_by = $createBy";
// 		}
		if($projectId != null && $projectId != ""){
			$where.= " and project_id = $projectId";
		}
		if($num != null && $num != ""){
			$where.= " and version_num = $num";
		}
		$item = ObjectUtils::arrToObj($paramArr, $item);
		$arr = $itemMapper->find($item,$where);
		return $arr;
	}
	

	
}

?>
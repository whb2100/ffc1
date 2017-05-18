<?php
namespace utils;

use common\Constants;

class ReturnResult {
	public static function returnMsg($isSuccess){
		$arr = array();
		$language = $_SESSION['language'];
		if($isSuccess){
			$arr['result'] = Constants::RESULT_CODE_SUCCESS;
			if($language == 'en'){
				$arr['msg'] = Constants::OPERATION_SUCCESS_EN;
			}else{
				$arr['msg'] = Constants::OPERATION_SUCCESS;
			}
		}else{
			$arr['result'] = Constants::RESULT_CODE_FAIL_DB;
			if($language == 'en'){
				$arr['msg'] = Constants::OPERATION_FAILURE_EN;
			}else{
				$arr['msg'] = Constants::OPERATION_FAILURE;
			}
			
		}
		return $arr;
	}
}
?>
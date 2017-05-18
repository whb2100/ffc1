<?php

namespace basic\data;

use utils\ObjectUtils;
use utils\ReturnResult;
use dao\Db;
use common\Constants;
use utils\ExcelUtils;

class CurrencyCodeFunction {
	
	public static function retrieveitem($paramArr){
		$arr = array();
		$currencyCodeMapper = new CurrencyCodeMapper();
		$currencyCode = new CurrencyCode();
		$currencyCode = ObjectUtils::arrToObj($paramArr, $currencyCode);
		$arr = $currencyCodeMapper->findAll($currencyCode);
		return $arr;
	}
	
}

?>
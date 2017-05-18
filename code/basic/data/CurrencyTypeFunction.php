<?php

namespace basic\data;

use utils\ObjectUtils;
use utils\ReturnResult;
use dao\Db;
use common\Constants;
use utils\ExcelUtils;

class CurrencyTypeFunction {
	
	public static function retrieveitem($paramArr){
		$arr = array();
		$currencyTypeMapper = new CurrencyTypeMapper();
		$currencyType = new CurrencyType();
		if($paramArr['order_by'] != "" && $paramArr['order_by'] != null){
			$orderBy = " order by currency_type asc";
		}
		$currencyType = ObjectUtils::arrToObj($paramArr, $currencyType);
		$arr = $currencyTypeMapper->findAll($currencyType , $orderBy);
		return $arr;
	}
	
	public static function createitem($paramArr){
		$itemMapper = new CurrencyTypeMapper();
		$item = new CurrencyType();
		$item->setCurrency_type($paramArr['currency_type1']);
		$res = $itemMapper->save($item);
		return $res;
	}
	
	public static function updateitem($paramArr){
		$arr = array();
		$itemMapper = new CurrencyTypeMapper();
		$item = new CurrencyType();
		$item->setCurrency_type_id($paramArr['currency_type_id']);
		$item->setCurrency_type($paramArr['currency_type1']);
		$res = $itemMapper->update($item);
		return $res;
	}
	
}

?>
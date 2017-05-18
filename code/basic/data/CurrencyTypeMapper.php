<?php

namespace basic\data;

use dao\Mapper;
use dao\Db;

class CurrencyTypeMapper extends Mapper{
	function __construct(){
		$this->conn =  Db::getInstance();
	}
}

?>
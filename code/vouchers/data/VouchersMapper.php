<?php

namespace vouchers\data;

use dao\Mapper;
use dao\Db;

class VouchersMapper extends Mapper{
	function __construct(){
		$this->conn =  Db::getInstance();
	}
}

?>
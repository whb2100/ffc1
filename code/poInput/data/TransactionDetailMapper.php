<?php

namespace poInput\data;

use dao\Mapper;
use dao\Db;

class TransactionDetailMapper extends Mapper{
	function __construct(){
		$this->conn =  Db::getInstance();
	}
}

?>
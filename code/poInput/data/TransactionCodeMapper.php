<?php

namespace poInput\data;

use dao\Mapper;
use dao\Db;

class TransactionCodeMapper extends Mapper{
	function __construct(){
		$this->conn =  Db::getInstance();
	}
}

?>
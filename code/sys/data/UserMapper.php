<?php

namespace sys\data;

use dao\Mapper;
use dao\Db;

class UserMapper extends Mapper{
	function __construct(){
		$this->conn =  Db::getInstance();
	}
	
	public function findBySQL($sql) {
		return $this->conn->executeAsoc2($sql, array());
	}
}

?>
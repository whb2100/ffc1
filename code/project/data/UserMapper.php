<?php

namespace project\data;

use dao\Mapper;
use dao\Db;

class UserMapper extends Mapper {
	
	function __construct() {
		$this->conn =  Db::getInstance();
	}

	
}

?>
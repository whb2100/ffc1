<?php

namespace sys\data;

use dao\Mapper;
use dao\Db;

class RoleMapper extends Mapper{
	function __construct(){
		$this->conn =  Db::getInstance();
	}
}

?>
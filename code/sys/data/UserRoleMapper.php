<?php

namespace sys\data;

use dao\Mapper;
use dao\Db;

class UserRoleMapper extends Mapper{
	function __construct(){
		$this->conn =  Db::getInstance();
	}
}

?>
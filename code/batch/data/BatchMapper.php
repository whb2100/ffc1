<?php

namespace batch\data;

use dao\Mapper;
use dao\Db;

class BatchMapper extends Mapper{
	function __construct(){
		$this->conn =  Db::getInstance();
	}
}

?>
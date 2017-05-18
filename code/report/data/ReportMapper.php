<?php
namespace report\data;
use dao\Mapper;
use dao\Db;

class ReportMapper extends Mapper{
	function __construct(){
		$this->conn =  Db::getInstance();
	}
}

?>
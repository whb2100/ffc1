<?php 
namespace budget\data;

use dao\Mapper;
use dao\Db;

class HistoryMapper extends Mapper{
	function __construct(){
		$this->conn =  Db::getInstance();
	}
}

?>